@if(Session::has('toastr_message'))
    <link href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        toastr.options = {'closeButton': true,'positionClass':'toast-bottom-right'};
        toastr.{{ Session::get('toastr_type') }}('{{ Session::get('toastr_message') }}');
    </script>
@endif