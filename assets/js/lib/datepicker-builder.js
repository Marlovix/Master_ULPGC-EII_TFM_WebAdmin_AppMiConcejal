function createDatePicker() {
    var date = $('.datepicker');
    date.datepicker({
        format: "dd/mm/yyyy",
        language: "es",
        weekStart: 1,
        calendarWeeks: true,
        autoclose: true,
        todayHighlight: true
    });
}