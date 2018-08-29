<script src="/js/jquery.js"></script>
<script src="/js/jquery.datetimepicker.full.min.js"></script>
<script src="/js/bootstrap3-typeahead.js"></script>

<script type="text/javascript" src="/js/parsley.min.js"></script>

<script type="text/javascript" src="{{ asset('js/tableExport/tableExport.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/tableExport/jquery.base64.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/tableExport/jspdf/libs/sprintf.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/tableExport/jspdf/jspdf.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/tableExport/jspdf/libs/base64.js') }}"></script>




<script src="/js/utilities.js"></script>

 <!-- load our application -->

<script src="/js/main.js"></script>



    <script type="text/javascript">
   


    $('input.visitorName').typeahead({
        source:  function (query, process) {
        return $.get("{{ route('autocomplete','vn') }}", { query: query }, function (data) {
                return process(data);
            });
        }
    });
   
    $('input.visitorNPhone').typeahead({
        source:  function (query, process) {
        return $.get("{{ route('autocomplete','vP') }}", { query: query }, function (data) {
                return process(data);
            });
        }
    });
    $('input.visitorEmail').typeahead({
        source:  function (query, process) {
        return $.get("{{ route('autocomplete','vE') }}", { query: query }, function (data) {
                return process(data);
            });
        }
    });


       $('input.visitorCompanyName').typeahead({
        source:  function (query, process) {
        return $.get("{{ route('autocomplete','vC') }}", { query: query }, function (data) {
                return process(data);
            });
        }
    });

        $('input.meetingTopic').typeahead({
        source:  function (query, process) {
        return $.get("{{ route('autocomplete','mT') }}", { query: query }, function (data) {
                return process(data);
            });
        }
    });

        $('textarea.visitReason').typeahead({
        source:  function (query, process) {
        return $.get("{{ route('autocomplete','mP') }}", { query: query }, function (data) {
                return process(data);
            });
        }
    });

          $('input.driverName').typeahead({
        source:  function (query, process) {
        return $.get("{{ route('autocomplete','driverN') }}", { query: query }, function (data) {
                return process(data);
            });
        }
    });

             $('input.firm').typeahead({
        source:  function (query, process) {
        return $.get("{{ route('autocomplete','firm') }}", { query: query }, function (data) {
                return process(data);
            });
        }
    });

     $('input.vehicleLicensePlate').typeahead({
        source:  function (query, process) {
        return $.get("{{ route('autocomplete','vehiclePlate') }}", { query: query }, function (data) {
                return process(data);
            });
        }
    });
        $('input.dropperCompany').typeahead({
        source:  function (query, process) {
        return $.get("{{ route('autocomplete','dropC') }}", { query: query }, function (data) {
                return process(data);
            });
        }
    });ReceiverName
        $('input.dropperName').typeahead({
        source:  function (query, process) {
        return $.get("{{ route('autocomplete','dropN') }}", { query: query }, function (data) {
                return process(data);
            });
        }
    });
        $('input.ReceiverName').typeahead({
        source:  function (query, process) {
        return $.get("{{ route('autocomplete','dropR') }}", { query: query }, function (data) {
                return process(data);
            });
        }
    });
</script>

<script>

jQuery(function(){
 jQuery('#meetStartDate').datetimepicker({
     
  format:'Y/m/d H:i',
  minDate:0,
    step: 30,
  onShow:function( ct ){
   this.setOptions({
    maxDate:jQuery('#meetEndDate').val()?jQuery('#meetEndDate').val():false
   })
  },
  beforeShowDay: function(date) {
        var day = date.getDay();
        return [(day != 0), ''];
    }
 });
 
 jQuery('#meetEndDate').datetimepicker({
  format:'Y/m/d H:i',
  minDate:0,
  step: 30,
  onShow:function( ct ){
   this.setOptions({
    minDate:jQuery('#meetStartDate').val()?jQuery('#meetStartDate').val():false,
    maxDate:jQuery('#meetStartDate').val()?jQuery('#meetStartDate').val():false,
   })
  },
  beforeShowDay: function(date) {
        var day = date.getDay();
        return [(day != 0), ''];
    }
 });
});
</script>