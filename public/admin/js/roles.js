document.addEventListener('DOMContentLoaded', function () {
    var allToggle = document.querySelector('[data-select-all-permissions]');
    var checkboxes = Array.from(document.querySelectorAll('[data-permission-checkbox]'));

    function setChecked(items, checked) {
        items.forEach(function (checkbox) {
            checkbox.checked = checked;
        });
    }

    if (allToggle) {
        allToggle.addEventListener('click', function () {
            var shouldCheck = checkboxes.some(function (checkbox) { return !checkbox.checked; });
            setChecked(checkboxes, shouldCheck);
            allToggle.innerHTML = shouldCheck
                ? '<i class="bi bi-dash-square me-2"></i>Deselect all'
                : '<i class="bi bi-check2-square me-2"></i>Select all';
        });
    }

    document.querySelectorAll('[data-select-group]').forEach(function (button) {
        button.addEventListener('click', function () {
            var group = button.closest('[data-permission-group]');
            var items = Array.from(group.querySelectorAll('[data-permission-checkbox]'));
            var shouldCheck = items.some(function (checkbox) { return !checkbox.checked; });
            setChecked(items, shouldCheck);
            button.textContent = shouldCheck ? 'Clear' : 'All';
        });
    });
});
