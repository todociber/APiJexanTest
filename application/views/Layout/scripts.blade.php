<script>
    $(document).ready(function() {
        $('#sellerForm')
            .find('[name="phoneNumber"]')
            .intlTelInput({
                utilsScript: '{{base_url()}}/resources/intl-tel-input/lib/libphonenumber/build/utils.js',
                autoPlaceholder: true,
                preferredCountries: [ "us", "sv" ]

            });
        @if(isset($_SESSION['countryName']))
        $("#phoneNumber").intlTelInput("setNumber", "{!!@$_SESSION['phoneNumber']!!}");
        $("#phoneNumber").intlTelInput("setCountry", '{!! @$_SESSION['countryName'] !!}');
        habilitate();
        GetRegionsLoad({!! @$_SESSION['countryFind'] !!});
        @endif




    });
    $("#phoneNumber").on("countrychange", function(e, countryData) {
        validator();
    });

</script>
<script>
    function habilitate() {
        var countryData = $("#phoneNumber").intlTelInput("getSelectedCountryData");
        document.getElementById('countryName').value=countryData.iso2;
        document.getElementById('countryExtension').value=countryData.dialCode;
        document.getElementById('validation').innerHTML = 'format valid';
        document.getElementById('save').disabled = false;
    }
    function validator() {
        var isValid = $("#phoneNumber").intlTelInput("isValidNumber");
        console.log('Validator Iniciado'+isValid);
        if(isValid){
            var countryData = $("#phoneNumber").intlTelInput("getSelectedCountryData");
            document.getElementById('countryName').value=countryData.iso2;
            document.getElementById('countryExtension').value=countryData.dialCode;
            document.getElementById('validation').innerHTML = 'format valid';
            document.getElementById('save').disabled = false;
        }else{
            var error = $("#phoneNumber").intlTelInput("getValidationError");
            document.getElementById('validation').innerHTML = 'format invalid';
            document.getElementById('countryExtension').value="";
            document.getElementById('countryName').value="";
            document.getElementById('save').disabled = true;
        }
    }
</script>
<script>

    $("#cities").select2({
        placeholder: '--- Select your city ---'
    });
    $("#country").select2({
        placeholder: '--- Select your country ---'
    });
    $("#regions").select2({
        placeholder: '--- Select your Region ---'
    });
    $('#example3').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        responsive: true,
        "autoWidth": true,
        "lengthMenu": [[50, 100, 150, 200], [50, 100, 150,200]]
    });
    $('#example4').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        responsive: true,
        "autoWidth": true,

        "order": [[3, 'asc'], [2, 'desc']]

    });


    $(document).ready(function () {
    })
</script>

<script>
    function GetRegionsLoad(dep) {
        $('#regions').find('option').remove();
        $('#cities').find('option').remove();
        //ELIMINANDO MUNICIPIOS DEL SELECT
        $('#divRegion').removeClass('add-Active');
        $('#divRegion').addClass('add-Innactive');
        $.ajax(
            {
                url: '{{base_url()}}get_regions/'+dep,
                type: 'GET',
                dataType: 'json',
                success: function (json, textStatus, xhr)
                {
                    waitingDialog.hide();
                    console.log('status ' + xhr.status);
                    $('#divRegion').removeClass('add-Innactive');
                    $('#divRegion').addClass('add-Active');
                    var counter=0;
                    var exist = 0;
                    json.forEach(function (entry)
                    {
                        @if(!isset($_SESSION['regions']))
                        if(counter==0)
                        {
                            counter=1;
                            GetCityCountry(entry.id);
                        }
                        @else
                        if(entry.id == '{!! @$_SESSION['regions'] !!}')
                        {
                            exist=1;
                            GetCityCountry(entry.id);
                            $("#regions").append('<option value="' + entry.id + '" selected>' + entry.name + '</option>');
                        }
                        @endif
$("#regions").append('<option value="' + entry.id + '">' + entry.name + '</option>');
                    });
                    if(exist==0)
                    {
                        json.forEach(function (entry)
                        {
                            if(counter==0)
                            {
                                counter=1;
                                GetCityCountry(entry.id);
                            }
                        });
                    }
                }
            });
        $('#divCity').removeClass('add-Innactive');

    }

    function GetCityCountry(dep) {

        $('#cities').find('option').remove();

        $('#divCity').removeClass('add-Active');
        $('#divCity').addClass('add-Innactive');
        $.ajax({

            url: '{{base_url()}}get_city/'+dep,
            type: 'GET',
            dataType: 'json',
            success: function (json, textStatus, xhr)
            {
                waitingDialog.hide();
                console.log('status ' + xhr.status);
                $('#divCity').removeClass('add-Innactive');
                $('#divCity').addClass('add-Active');
                json.forEach(function (entry)
                {
                    if(entry.id == '{!! @$_SESSION['cities'] !!}')
                    {
                        $("#cities").append('<option value="' + entry.id + '" selected>' + entry.name + '</option>');
                    }
                    else
                    {
                        $("#cities").append('<option value="' + entry.id + '">' + entry.name + '</option>');
                    }

                });
            }



        });
    }
</script>