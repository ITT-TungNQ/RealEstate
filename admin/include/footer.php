<div class="row-fluid">
    <div id="footer" class="span12">
        2017 &copy; ITT Team Admin. Brought to you by <a href="https://facebook.com/100001696925710">TùngNQ</a> </div>
</div>

<script src="http://192.168.1.220:8080/RealEstate/admin/js/excanvas.min.js"></script> 
<script src="http://192.168.1.220:8080/RealEstate/admin/js/jquery.min.js"></script> 
<script src="http://192.168.1.220:8080/RealEstate/admin/js/jquery.ui.custom.js"></script> 
<script src="http://192.168.1.220:8080/RealEstate/admin/js/bootstrap.min.js"></script> 
<script src="http://192.168.1.220:8080/RealEstate/admin/js/jquery.flot.min.js"></script> 
<script src="http://192.168.1.220:8080/RealEstate/admin/js/jquery.flot.resize.min.js"></script> 
<script src="http://192.168.1.220:8080/RealEstate/admin/js/jquery.peity.min.js"></script> 
<script src="http://192.168.1.220:8080/RealEstate/admin/js/matrix.js"></script> 
<script src="http://192.168.1.220:8080/RealEstate/admin/js/fullcalendar.min.js"></script> 
<script src="http://192.168.1.220:8080/RealEstate/admin/js/matrix.calendar.js"></script> 
<script src="http://192.168.1.220:8080/RealEstate/admin/js/matrix.chat.js"></script> 
<script src="http://192.168.1.220:8080/RealEstate/admin/js/jquery.validate.js"></script> 
<script src="http://192.168.1.220:8080/RealEstate/admin/js/matrix.form_validation.js"></script> 
<script src="http://192.168.1.220:8080/RealEstate/admin/js/jquery.wizard.js"></script> 
<script src="http://192.168.1.220:8080/RealEstate/admin/js/jquery.uniform.js"></script> 
<script src="http://192.168.1.220:8080/RealEstate/admin/js/select2.min.js"></script> 
<script src="http://192.168.1.220:8080/RealEstate/admin/js/matrix.popover.js"></script> 
<script src="http://192.168.1.220:8080/RealEstate/admin/js/jquery.dataTables.min.js"></script> 
<script src="http://192.168.1.220:8080/RealEstate/admin/js/matrix.tables.js"></script>

<!-- START: FORM DATEPICKER -->
<script src="http://192.168.1.220:8080/RealEstate/admin/js/bootstrap-colorpicker.js"></script>
<script src="http://192.168.1.220:8080/RealEstate/admin/js/bootstrap-datepicker.js"></script>
<script src="http://192.168.1.220:8080/RealEstate/admin/js/masked.js"></script>  
<script src="http://192.168.1.220:8080/RealEstate/admin/js/matrix.form_common.js"></script>
<!-- END: FORM DATEPICKER -->
<script type="text/javascript">
    // This function is called from the pop-up menus to transfer to
    // a different page. Ignore if the value returned is a null string:
    function goPage(newURL) {

        // if url is empty, skip the menu dividers and reset the menu selection to default
        if (newURL != "") {

            // if url is "-", it is this page -- reset the menu:
            if (newURL == "-") {
                resetMenu();
            }
            // else, send page to designated URL            
            else {
                document.location.href = newURL;
            }
        }
    }

// resets the menu selection upon entry to this page:
    function resetMenu() {
        document.gomenu.selector.selectedIndex = 2;
    }
</script>