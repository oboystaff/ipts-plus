@extends('layout.base')

@section('page-styles')
    <link rel="stylesheet" href="{{ asset('assets/css/lightgallery.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fileinput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/autocomplete.css') }}">
    <!-- Leaflet css -->
    <link href="{{ asset('assets/app/map/leaflet/leaflet.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/app/map/leaflet/OverPassLayer.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/app/map/leaflet/leaflet-geoman.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/app/map/leaflet/L.Control.SlideMenu.css') }}" rel="stylesheet">
@endsection

@section('page-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header flex-wrap d-flex justify-content-between">
                        <div>
                            <h4 class="card-title">Edit Assembly</h4>
                        </div>

                        <div>
                            <a href="{{ route('assembly.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger mt-2">
                            <strong>Please fix the following errors:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">
                        <form class="row g-3 needs-validation" action="{{ route('assembly.update', $assembly->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" id="supervisor" name="supervisor" value="{{ $assembly->supervisor }}">
                            <input type="hidden" name="geo_coordinate" id="geo_coordinate">
                            <input type="hidden" name="assembly_url" url="{{ route('assembly.fetch') }}">

                            <div class="mb-3 col-md-6">
                                <label for="role_access" class="form-label">Regional Name</label>
                                <select class="form-control @error('regional_code') is-invalid @enderror" id="regional_code"
                                    name="regional_code" required>
                                    <option value="">Select Region Name</option>
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->regional_code }}"
                                            {{ old('regional_code', $assembly->regional_code ?? '') == $region->regional_code ? 'selected' : '' }}>
                                            {{ $region->name }}</option>
                                    @endforeach
                                </select>

                                @error('regional_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Assembly Name</label>
                                <select class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" required>
                                    <option value="">Select Assembly Name</option>
                                    @foreach ($mmdas as $mmda)
                                        <option code="{{ $mmda->assembly_code }}" value="{{ $mmda->assembly_name }}"
                                            {{ old('name', $assembly->name ?? '') == $mmda->assembly_name ? 'selected' : '' }}>
                                            {{ $mmda->assembly_name }}</option>
                                    @endforeach
                                </select>

                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="assembly_code" class="form-label">Assembly Code</label>
                                <input type="text" class="form-control @error('assembly_code') is-invalid @enderror"
                                    id="assembly_code" name="assembly_code" value="{{ $assembly->assembly_code }}"
                                    readonly>

                                @error('assembly_code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status"
                                    name="status">
                                    <option disabled selected>Select Status</option>
                                    <option value="Active" {{ $assembly->status == 'Active' ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="Inactive" {{ $assembly->status == 'Inactive' ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>

                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="supervisor" class="form-label">Assembly Admin</label>
                                <div class="autocomplete">
                                    <input type="text" class="form-control @error('supervisor_id') is-invalid @enderror"
                                        placeholder="Enter Assembly Admin" id="supervisor_id" name="supervisor_id"
                                        value="{{ $assembly->assemblySupervisor->name ?? '' }}">
                                </div>

                                @error('supervisor_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" class="form-label">Address</label>
                                <div class="autocomplete">
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        placeholder="Enter Assembly Address" id="address" name="address"
                                        value="{{ $assembly->address }}">
                                </div>

                                @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" class="form-label">Phone Number</label>
                                <div class="autocomplete">
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        placeholder="Enter Assembly Phone" id="phone" name="phone"
                                        value="{{ $assembly->phone }}">
                                </div>

                                @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        @if (isset($assembly->logo))
                                            <label>Assembly Logo</label>
                                            <img src="{{ asset('storage/images/logo/' . $assembly->logo) }}"
                                                width="300" height="340" style="border-radius: 10px;">
                                        @else
                                            <h4 style="color:red">No logo uploaded for the selected assembly</h4>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label for="message">Upload New Assembly Logo</label>
                                        <input class="file" id="logo" name="logo" type="file"
                                            data-show-upload="false" data-theme="fa" data-max-file-count=""
                                            data-max-total-file-count="" data-initial-preview-as-data="true" ,
                                            data-initial-preview="" data-initial-preview-config="" data-required="false"
                                            data-overwrite-initial="false" data-max-file-size="15000"
                                            data-browse-label="Browse"
                                            data-browse-icon="<i class='fa fa-folder-open'></i>" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        @if (isset($assembly->invoice_layout))
                                            <label>Assembly Invoice Template</label>
                                            <img src="{{ asset('assets/images/template/' . $assembly->invoice_layout) }}"
                                                width="300" height="340" style="border-radius: 10px;">
                                        @else
                                            <h4 style="color:red">No template uploaded for the selected assembly</h4>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label for="message">Select New Assembly Template</label>
                                        <div class="row">
                                            <div class="col-md-12" style="margin-bottom: 100px">
                                                <div class="template-container">
                                                    <input type="radio" name="invoice_layout" class="template-radio"
                                                        id="template1-radio" value="target001.png">
                                                    <a href="javascript:;" class="flex text-primary template"
                                                        data-bs-toggle="modal" data-bs-target="#template1-preview">
                                                        Template 1</a>
                                                </div>
                                            </div>

                                            <div class="col-md-12" style="margin-bottom: 100px">
                                                <div class="template-container">
                                                    <input type="radio" name="invoice_layout" class="template-radio"
                                                        id="template2-radio" value="target001.png">
                                                    <a href="javascript:;" class="flex text-primary template"
                                                        data-bs-toggle="modal" data-bs-target="#template2-preview">
                                                        Template 2</a>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="template-container">
                                                    <input type="radio" name="invoice_layout" class="template-radio"
                                                        id="template3-radio" value="target001.png">
                                                    <a href="javascript:;" class="flex text-primary template"
                                                        data-bs-toggle="modal" data-bs-target="#template3-preview">
                                                        Template 3</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="phone">Select Assembly Boundary</label>
                                <div id="map" style="height: 500px;"></div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="template1-preview">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Assembly Invoice Template (Template 1)</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-4 col-md-6">
                                <img src="{{ asset('assets/images/template/target001.png') }}" width="720"
                                    height="450" style="border-radius: 10px;">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="template2-preview">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Assembly Invoice Template (Template 2)</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-4 col-md-6">
                                <div class="mb-4 col-md-6">
                                    <img src="{{ asset('assets/images/template/target001.png') }}" width="720"
                                        height="450" style="border-radius: 10px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="template3-preview">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Assembly Invoice Template (Template 3)</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-4 col-md-6">
                                <div class="mb-4 col-md-6">
                                    <img src="{{ asset('assets/images/template/target001.png') }}" width="720"
                                        height="450" style="border-radius: 10px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('page-scripts')
    <script src="{{ asset('assets/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('assets/js/lightgallery-all.min.js') }}"></script>
    <!-- leaflet js-->
    <script src="{{ asset('assets/app/map/geojsonhint.js') }}"></script>
    <script src="{{ asset('assets/app/map/geojsonUtil.js') }}"></script>
    <script src="{{ asset('assets/app/map/leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('assets/app/map/leaflet/OverPassLayer.bundle.js') }}"></script>
    <script src="{{ asset('assets/app/map/leaflet/Leaflet.Control.Custom.js') }}"></script>
    <script src="{{ asset('assets/app/map/leaflet/leaflet-geoman.min.js') }}"></script>
    <script src="{{ asset('assets/app/map/leaflet/L.Control.SlideMenu.js') }}"></script>
    <script src="{{ asset('assets/app/map/leaflet/easy-button.js') }}"></script>
    <script src="{{ asset('assets/app/map/leaflet/osmtogeojson.js') }}"></script>
    <script src="{{ asset('assets/app/map/StyleFactory.js') }}"></script>
    <script src="{{ asset('assets/app/map/MapTileProvider.js') }}"></script>
    <script src="{{ asset('assets/app/map/MapController.js?v=' . \Illuminate\Support\Str::random(5)) }}"></script>
    <script src="{{ asset('assets/js/general.js?v=' . time()) }}"></script>


    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function autocomplete(inp, arr) {
                /*the autocomplete function takes two arguments,
                the text field element and an array of possible autocompleted values:*/
                var currentFocus;
                /*execute a function when someone writes in the text field:*/
                inp.addEventListener("input", function(e) {
                    var a, b, i, val = this.value;
                    /*close any already open lists of autocompleted values*/
                    closeAllLists();
                    if (!val) {
                        return false;
                    }
                    currentFocus = -1;
                    /*create a DIV element that will contain the items (values):*/
                    a = document.createElement("DIV");
                    a.setAttribute("id", this.id + "autocomplete-list");
                    a.setAttribute("class", "autocomplete-items");
                    /*append the DIV element as a child of the autocomplete container:*/
                    this.parentNode.appendChild(a);
                    /*for each item in the array...*/
                    for (i = 0; i < arr.length; i++) {
                        /*check if the item starts with the same letters as the text field value:*/
                        if (arr[i].name.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                            /*create a DIV element for each matching element:*/
                            b = document.createElement("DIV");
                            /*make the matching letters bold:*/
                            b.innerHTML = "<strong>" + arr[i].name.substr(0, val.length) + "</strong>";
                            b.innerHTML += arr[i].name.substr(val.length);
                            /*insert a input field that will hold the current array item's value:*/
                            b.innerHTML += "<input type='hidden' value='" + arr[i].name + "'>";
                            b.innerHTML += "<input type='hidden' value='" + arr[i].id + "'>";
                            /*execute a function when someone clicks on the item value (DIV element):*/
                            b.addEventListener("click", function(e) {
                                /*insert the value for the autocomplete text field:*/
                                inp.value = this.getElementsByTagName("input")[0].value;
                                var supervisorId = this.getElementsByTagName("input")[1].value;

                                document.getElementById('supervisor').value = supervisorId;
                                /*close the list of autocompleted values,
                                (or any other open lists of autocompleted values:*/
                                closeAllLists();
                            });
                            a.appendChild(b);
                        }
                    }
                });

                /*execute a function presses a key on the keyboard:*/
                inp.addEventListener("keydown", function(e) {
                    var x = document.getElementById(this.id + "autocomplete-list");
                    if (x) x = x.getElementsByTagName("div");
                    if (e.keyCode == 40) {
                        /*If the arrow DOWN key is pressed,
                        increase the currentFocus variable:*/
                        currentFocus++;
                        /*and and make the current item more visible:*/
                        addActive(x);
                    } else if (e.keyCode == 38) { //up
                        /*If the arrow UP key is pressed,
                        decrease the currentFocus variable:*/
                        currentFocus--;
                        /*and and make the current item more visible:*/
                        addActive(x);
                    } else if (e.keyCode == 13) {
                        /*If the ENTER key is pressed, prevent the form from being submitted,*/
                        e.preventDefault();
                        if (currentFocus > -1) {
                            /*and simulate a click on the "active" item:*/
                            if (x) x[currentFocus].click();
                        }
                    }
                });

                function addActive(x) {
                    /*a function to classify an item as "active":*/
                    if (!x) return false;
                    /*start by removing the "active" class on all items:*/
                    removeActive(x);
                    if (currentFocus >= x.length) currentFocus = 0;
                    if (currentFocus < 0) currentFocus = (x.length - 1);
                    /*add class "autocomplete-active":*/
                    x[currentFocus].classList.add("autocomplete-active");
                }

                function removeActive(x) {
                    /*a function to remove the "active" class from all autocomplete items:*/
                    for (var i = 0; i < x.length; i++) {
                        x[i].classList.remove("autocomplete-active");
                    }
                }

                function closeAllLists(elmnt) {
                    /*close all autocomplete lists in the document,
                    except the one passed as an argument:*/
                    var x = document.getElementsByClassName("autocomplete-items");
                    for (var i = 0; i < x.length; i++) {
                        if (elmnt != x[i] && elmnt != inp) {
                            x[i].parentNode.removeChild(x[i]);
                        }
                    }
                }

                /*execute a function when someone clicks in the document:*/
                document.addEventListener("click", function(e) {
                    closeAllLists(e.target);
                });
            }

            /*An array containing all the customer ids in the customer table:*/
            var supervisors = @json($supervisors);

            autocomplete(document.getElementById("supervisor_id"), supervisors);

            //End of auto complete

            const map = L.map('map').setView([7.95277, -1.03071], 6);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            L.control.layers(MapController.getBaseMaps()).addTo(map);

            map.pm.addControls({
                drawMarker: true,
                drawPolygon: true,
                editPolygon: true,
                drawPolyline: true,
                editMode: true,
                deleteLayer: true
            });

            var content = '<div class="input-group">' +
                '    <input type="text" class="form-control input-sm" placeholder="Enter Address" id="input-geocode-search" value="Adenta,Accra">' +
                '    <span class="input-group-btn">' +
                '        <button  id="btn-geocode-search" class="btn btn-primary btn-sm" type="button" title="Search An Address"><i class="icofont icofont-search"></i> Search</button>' +
                '    </span>' +
                '</div>';
            L.control.slideMenu(content, {
                position: 'topright',
                width: '600px',
                height: '50px',
                menuposition: 'topright',
                icon: 'fa-search'

            }).addTo(map);

            map.on('pm:create', function(event) {
                const workingLayer = event.layer;

                if (workingLayer !== null) {
                    const geoJsonData = workingLayer.toGeoJSON();
                    const polygonCoordinates = geoJsonData.geometry.coordinates;
                    const geo_coordinate = JSON.stringify(polygonCoordinates);

                    $("input[name='geo_coordinate']").val(geo_coordinate);
                } else {
                    alert("Invalid input")
                }
            });

            const rawData = @json($assembly->geo_coordinate);
            const parsedData = JSON.parse(rawData);
            const boundaries = formatBoundaries(parsedData);

            const allBounds = [];
            boundaries.forEach(boundary => {
                if (boundary.type === 'polygon') {
                    const coordinates = JSON.parse(boundary.coordinates).map(coord => [coord[1], coord[
                        0]]); // Swap latitude and longitude
                    L.polygon(coordinates, {
                        color: 'blue',
                        fillColor: '#3388ff',
                        fillOpacity: 0.5
                    }).addTo(map);
                    allBounds.push(...coordinates);
                } else if (boundary.type === 'circle') {
                    const center = JSON.parse(boundary.coordinates).center;
                    const radius = JSON.parse(boundary.coordinates).radius;
                    L.circle([center.lat, center.lng], {
                        radius: radius,
                        color: 'red',
                        fillColor: '#f03',
                        fillOpacity: 0.5
                    }).addTo(map);
                    allBounds.push([center.lat, center.lng]);
                } else if (boundary.type === 'line') {
                    const lineCoordinates = JSON.parse(boundary.coordinates).map(coord => [coord[1], coord[
                        0]]); // Swap latitude and longitude
                    L.polyline(lineCoordinates, {
                        color: 'green'
                    }).addTo(map);
                    allBounds.push(...lineCoordinates);
                }
            });

            if (allBounds.length > 0) {
                const bounds = L.latLngBounds(allBounds);
                map.fitBounds(bounds);
            }

            function formatBoundaries(rawData) {
                const formattedBoundaries = rawData.map(data => {
                    if (Array.isArray(data)) {
                        const isPolygon = Array.isArray(data[0]) && Array.isArray(data[data.length - 1]) &&
                            data[0][0] === data[data.length - 1][0] &&
                            data[0][1] === data[data.length - 1][1];

                        if (isPolygon) {
                            return {
                                type: 'polygon',
                                coordinates: JSON.stringify(data)
                            };
                        } else if (Array.isArray(data[0])) {
                            return {
                                type: 'line',
                                coordinates: JSON.stringify(data)
                            };
                        }
                    } else if (typeof data === 'object' && data.center && data.radius) {
                        return {
                            type: 'circle',
                            coordinates: JSON.stringify({
                                center: data.center,
                                radius: data.radius
                            })
                        };
                    }

                    return {
                        type: 'unknown',
                        coordinates: JSON.stringify(data)
                    };
                });

                return formattedBoundaries;
            }
        });
    </script>
@endsection
