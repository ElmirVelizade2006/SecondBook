<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;
use ZipArchive;


class BackupController extends Controller
{
    public function index()
    {
        $backupPath = storage_path('app/backups');


        if (!File::exists($backupPath)) {

            File::makeDirectory(
                $backupPath,
                0755,
                true
            );
        }


        $backups = collect(
            File::files($backupPath)
        )
            ->filter(function ($file) {

                return $file->getExtension() === 'zip';

            })
            ->sortByDesc(function ($file) {

                return $file->getMTime();

            })
            ->values();


        return view(
            'admin.backup.index',
            compact('backups')
        );
    }


    public function create(Request $request)
    {
        $backupPath = storage_path('app/backups');


        if (!File::exists($backupPath)) {

            File::makeDirectory(
                $backupPath,
                0755,
                true
            );
        }


        $timestamp = now()->format(
            'Y-m-d_H-i-s'
        );


        $sqlFileName = "database_{$timestamp}.sql";

        $zipFileName = "backup_{$timestamp}.zip";


        $sqlFilePath = $backupPath
            . DIRECTORY_SEPARATOR
            . $sqlFileName;

        $zipFilePath = $backupPath
            . DIRECTORY_SEPARATOR
            . $zipFileName;


        $database = config(
            'database.connections.mysql'
        );


        $host = $database['host'] ?? '127.0.0.1';

        $port = $database['port'] ?? 3306;

        $username = $database['username'] ?? 'root';

        $password = $database['password'] ?? '';

        $databaseName = $database['database'] ?? '';


        if (!$databaseName) {

            return back()->with(
                'error',
                'Database name could not be determined.'
            );
        }


        $mysqldump =
            'C:\\laragon\\bin\\mysql\\mysql-8.0.30-winx64\\bin\\mysqldump.exe';


        if (!File::exists($mysqldump)) {

            return back()->with(
                'error',
                'mysqldump.exe was not found at: ' . $mysqldump
            );
        }


        $command = [
            $mysqldump,
            '--host=' . $host,
            '--port=' . $port,
            '--user=' . $username,
            '--result-file=' . $sqlFilePath,
            $databaseName,
        ];


        if ($password !== '') {

            $command = [
                $mysqldump,
                '--host=' . $host,
                '--port=' . $port,
                '--user=' . $username,
                '--password=' . $password,
                '--result-file=' . $sqlFilePath,
                $databaseName,
            ];
        }


        try {

            $process = new Process($command);

            $process->setTimeout(300);

            $process->run();

        } catch (\Throwable $e) {

            if (File::exists($sqlFilePath)) {

                File::delete($sqlFilePath);
            }


            return back()->with(
                'error',
                'Database backup failed: ' . $e->getMessage()
            );
        }


        if (
            !$process->isSuccessful()
            || !File::exists($sqlFilePath)
            || File::size($sqlFilePath) === 0
        ) {

            if (File::exists($sqlFilePath)) {

                File::delete($sqlFilePath);
            }


            $error = trim(
                $process->getErrorOutput()
            );


            return back()->with(
                'error',
                $error !== ''
                    ? 'Database backup failed: ' . $error
                    : 'Database backup could not be created.'
            );
        }


        $zip = new ZipArchive();


        $zipResult = $zip->open(
            $zipFilePath,
            ZipArchive::CREATE | ZipArchive::OVERWRITE
        );


        if ($zipResult !== true) {

            File::delete($sqlFilePath);


            return back()->with(
                'error',
                'Backup archive could not be created.'
            );
        }


        $zip->addFile(
            $sqlFilePath,
            $sqlFileName
        );


        $zip->close();


        if (File::exists($sqlFilePath)) {

            File::delete($sqlFilePath);
        }


        if (!File::exists($zipFilePath)) {

            return back()->with(
                'error',
                'Backup file could not be created.'
            );
        }


        return back()->with(
            'success',
            'Backup created successfully.'
        );
    }


    public function download($file)
    {
        $backupPath = storage_path('app/backups');


        $fileName = basename($file);

        $filePath = $backupPath
            . DIRECTORY_SEPARATOR
            . $fileName;


        if (
            !File::exists($filePath)
            || pathinfo($filePath, PATHINFO_EXTENSION) !== 'zip'
        ) {

            return redirect()
                ->route('admin.backup.index')
                ->with(
                    'error',
                    'Backup file not found.'
                );
        }


        return response()->download(
            $filePath,
            $fileName
        );
    }


    public function delete($file)
    {
        $backupPath = storage_path('app/backups');


        $fileName = basename($file);

        $filePath = $backupPath
            . DIRECTORY_SEPARATOR
            . $fileName;


        if (
            !File::exists($filePath)
            || pathinfo($filePath, PATHINFO_EXTENSION) !== 'zip'
        ) {

            return back()->with(
                'error',
                'Backup file not found.'
            );
        }


        try {

            File::delete($filePath);

        } catch (\Throwable $e) {

            return back()->with(
                'error',
                'Backup could not be deleted: ' . $e->getMessage()
            );
        }


        return back()->with(
            'success',
            'Backup deleted successfully.'
        );
    }


    public function restore($file)
    {
        $backupPath = storage_path('app/backups');


        $fileName = basename($file);

        $zipFilePath = $backupPath
            . DIRECTORY_SEPARATOR
            . $fileName;


        if (
            !File::exists($zipFilePath)
            || pathinfo($zipFilePath, PATHINFO_EXTENSION) !== 'zip'
        ) {

            return back()->with(
                'error',
                'Backup file not found.'
            );
        }


        $zip = new ZipArchive();


        $zipResult = $zip->open(
            $zipFilePath
        );


        if ($zipResult !== true) {

            return back()->with(
                'error',
                'Backup archive could not be opened.'
            );
        }


        $sqlFileName = null;


        for ($i = 0; $i < $zip->numFiles; $i++) {

            $entryName = $zip->getNameIndex($i);


            if (
                $entryName !== false
                && pathinfo($entryName, PATHINFO_EXTENSION) === 'sql'
                && basename($entryName) === $entryName
            ) {

                $sqlFileName = $entryName;

                break;
            }
        }


        if (!$sqlFileName) {

            $zip->close();


            return back()->with(
                'error',
                'No SQL database file was found inside the backup.'
            );
        }


        $restorePath = storage_path(
            'app/backups/restore'
        );


        if (!File::exists($restorePath)) {

            File::makeDirectory(
                $restorePath,
                0755,
                true
            );
        }


        $sqlFilePath = $restorePath
            . DIRECTORY_SEPARATOR
            . basename($sqlFileName);


        try {

            if (
                !$zip->extractTo(
                    $restorePath,
                    [$sqlFileName]
                )
            ) {

                $zip->close();


                return back()->with(
                    'error',
                    'SQL backup could not be extracted.'
                );
            }


            $zip->close();


            $database = config(
                'database.connections.mysql'
            );


            $host = $database['host'] ?? '127.0.0.1';

            $port = $database['port'] ?? 3306;

            $username = $database['username'] ?? 'root';

            $password = $database['password'] ?? '';

            $databaseName = $database['database'] ?? '';


            if (!$databaseName) {

                return back()->with(
                    'error',
                    'Database name could not be determined.'
                );
            }


            $mysql = 'C:\\laragon\\bin\\mysql\\mysql-8.0.30-winx64\\bin\\mysql.exe';


            if (!File::exists($mysql)) {

                return back()->with(
                    'error',
                    'mysql.exe was not found at: ' . $mysql
                );
            }


            $command = [
                $mysql,
                '--host=' . $host,
                '--port=' . $port,
                '--user=' . $username,
                $databaseName,
            ];


            if ($password !== '') {

                $command = [
                    $mysql,
                    '--host=' . $host,
                    '--port=' . $port,
                    '--user=' . $username,
                    '--password=' . $password,
                    $databaseName,
                ];
            }


            $process = new Process($command);

            $process->setTimeout(300);


            $process->setInput(
                File::get($sqlFilePath)
            );


            $process->run();


            if (!$process->isSuccessful()) {

                $error = trim(
                    $process->getErrorOutput()
                );


                return back()->with(
                    'error',
                    $error !== ''
                        ? 'Database restore failed: ' . $error
                        : 'Database restore failed.'
                );
            }


        } catch (\Throwable $e) {

            return back()->with(
                'error',
                'Database restore failed: ' . $e->getMessage()
            );

        } finally {

            if (File::exists($sqlFilePath)) {

                File::delete($sqlFilePath);
            }
        }


        return back()->with(
            'success',
            'Database restored successfully.'
        );
    }
}

