<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<!--      Redactor -->
<link rel="stylesheet" href="{{ URL::to('/lib/redactor/redactor.css') }}" />
<script src="{{ URL::to('/lib/redactor/redactor.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(
        function ()
        {
            $('#redactor').redactor();
        }
);
</script>