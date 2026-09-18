<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $replySubject }}</title>
</head>

<body style="margin: 0; padding: 0; background-color: #f4f4f5; font-family: Arial, sans-serif;">

    <div style="max-width: 600px; margin: 40px auto; background: #ffffff; border-radius: 12px; padding: 32px;">

        <h2 style="margin-top: 0; color: #111827;">
            SecondBook
        </h2>

        <div style="height: 1px; background-color: #e5e7eb; margin: 20px 0;"></div>

        <div style="font-size: 15px; line-height: 1.7; color: #374151;">
            {!! nl2br(e($reply)) !!}
        </div>

        <div style="height: 1px; background-color: #e5e7eb; margin: 24px 0;"></div>

        <p style="margin: 0; color: #6b7280; font-size: 13px;">
            Best regards,<br>
            SecondBook Team
        </p>

    </div>

</body>
</html>