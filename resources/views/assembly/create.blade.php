@extends('layout.base')

@section('page-styles')
    <link rel="stylesheet" href="{{ asset('assets/css/lightgallery.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fileinput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/autocomplete.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-draw/1.0.4/leaflet.draw.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-draw/1.0.4/leaflet.draw.css" />
@endsection


@section('page-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header flex-wrap d-flex justify-content-between">
                        <div>
                            <h4 class="card-title">Create Assembly</h4>
                        </div>

                        <div>
                            <a href="{{ route('assembly.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="row g-3 needs-validation" method="POST" action="{{ route('assembly.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" id="supervisor" name="supervisor">
                            <input type="hidden" name="boundary" id="boundary">

                            <div class="mb-4 col-md-6">
                                <label class="form-label">Assembly Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter Role Name" name="name" required>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4 col-md-6">
                                <label class="form-label">Assembly Code</label>
                                <input type="text" class="form-control @error('assembly_code') is-invalid @enderror"
                                    placeholder="Enter Assembly Code" name="assembly_code" required>

                                @error('assembly_code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="role_access" class="form-label">Regional Name</label>
                                <select class="form-control @error('regional_code') is-invalid @enderror" id="regional_code"
                                    name="regional_code" required>
                                    <option value="">Select Region Name</option>
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->regional_code }}">{{ $region->name }}</option>
                                    @endforeach
                                </select>

                                @error('regional_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4 col-md-6">
                                <label class="form-label">Supervisor</label>
                                <div class="autocomplete">
                                    <input type="text" class="form-control @error('supervisor_id') is-invalid @enderror"
                                        placeholder="Enter Assembly Supervisor" id="supervisor_id" name="supervisor_id"
                                        required>
                                </div>

                                @error('supervisor_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4 col-md-6">
                                <label class="form-label">Address</label>
                                <div class="autocomplete">
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        placeholder="Enter Assembly Address" id="address" name="address" required>
                                </div>

                                @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4 col-md-6">
                                <label class="form-label">Phone Number</label>
                                <div class="autocomplete">
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        placeholder="Enter Assembly Phone" id="phone" name="phone" required>
                                </div>

                                @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4 col-md-12">
                                <label for="message">Upload Assembly Logo</label>
                                <input class="file" id="logo" name="logo" type="file" data-show-upload="false"
                                    data-theme="fa" data-max-file-count="" data-max-total-file-count=""
                                    data-initial-preview-as-data="true" , data-initial-preview=""
                                    data-initial-preview-config="" data-required="false" data-overwrite-initial="false"
                                    data-max-file-size="15000" data-browse-label="Browse"
                                    data-browse-icon="<i class='fa fa-folder-open'></i>" />
                                @if ($errors->any())
                                    <div class="alert alert-danger mt-2">
                                        <strong>Please re-upload files</strong>
                                    </div>
                                @endif
                            </div>

                            <div class="mb-4 col-md-12">
                                <label class="form-label">Assembly Invoice Template (Click to view templates)</label>

                                <div class="row" style="margin-bottom:40px">
                                    <div class="mb-4 col-md-4">
                                        <div class="template-container">
                                            <input type="radio" name="invoice_layout" class="template-radio"
                                                id="template1-radio" value="target001.png">
                                            <a href="javascript:;" class="flex text-primary template"
                                                data-bs-toggle="modal" data-bs-target="#template1-preview">
                                                Template 1</a>
                                        </div>
                                    </div>

                                    <div class="mb-4 col-md-4">
                                        <div class="template-container">
                                            <input type="radio" name="invoice_layout" class="template-radio"
                                                id="template2-radio" value="target001.png">
                                            <a href="javascript:;" class="flex text-primary template"
                                                data-bs-toggle="modal" data-bs-target="#template2-preview">
                                                Template 2</a>
                                        </div>
                                    </div>

                                    <div class="mb-4 col-md-4">
                                        <div class="template-container">
                                            <input type="radio" name="invoice_layout" class="template-radio"
                                                id="template3-radio" value="target001.png">
                                            <a href="javascript:;" class="flex text-primary template"
                                                data-bs-toggle="modal" data-bs-target="#template3-preview">
                                                Template 3</a>
                                        </div>
                                    </div>

                                    {{-- <div class="mb-4 col-md-12">
                                        <label class="form-label">Select Geo Reference Area</label>
                                        <div id="map" style="height: 500px;"></div>
                                    </div> --}}
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
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

        });
    </script>

    <script>
        let map = L.map('map').setView([7.9465, -1.0232], 7);

        let ghanaBounds = [
            [4.7387, -3.2609], // Southwest corner
            [11.1749, 1.1918], // Northeast corner
        ];

        map.setMaxBounds(ghanaBounds); // Restrict view to Ghana
        map.fitBounds(ghanaBounds);

        // Add OpenStreetMap layer
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        let ghanaGeoJSON = {
            "type": "Feature",
            "geometry": {
                "type": "Polygon",
                "coordinates": [
                    [
                        [-3.2609, 4.7387],
                        [1.1918, 4.7387],
                        [1.1918, 11.1749],
                        [-3.2609, 11.1749],
                        [-3.2609, 4.7387]
                    ]
                ]
            }
        };

        L.geoJSON(ghanaGeoJSON, {
            style: {
                color: "blue",
                weight: 2,
                fillOpacity: 0.1,
            },
        }).addTo(map);

        // Initialize Leaflet.Draw
        let drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        // let drawControl = new L.Control.Draw({
        //     edit: {
        //         featureGroup: drawnItems,
        //     },
        //     draw: {
        //         polygon: true,
        //         polyline: false,
        //         rectangle: false,
        //         circle: false,
        //         marker: false,
        //     },
        // });

        var drawControl = new L.Control.Draw({
            // position: 'topright',
            draw: {
                polygon: {
                    shapeOptions: {
                        color: 'purple'
                    },
                    allowIntersection: false,
                    drawError: {
                        color: 'orange',
                        timeout: 1000
                    },
                },
                polyline: {
                    shapeOptions: {
                        color: 'red'
                    },
                },
                rect: {
                    shapeOptions: {
                        color: 'green'
                    },
                },
                circle: {
                    shapeOptions: {
                        color: 'steelblue'
                    },
                },
            },
            edit: {
                featureGroup: drawnItems
            }
        });

        map.addControl(drawControl);

        // Custom Controls (Add to Zoom Control Area)
        let customControls = L.control({
            position: 'topleft'
        });

        customControls.onAdd = function() {
            let container = L.DomUtil.create('div', 'leaflet-bar leaflet-control');

            // Polygon Button
            let polygonButton = L.DomUtil.create('a', '', container);
            polygonButton.innerHTML = '⬠'; // Polygon icon
            polygonButton.title = "Draw Polygon";
            polygonButton.style.cursor = "pointer";
            polygonButton.style.fontSize = "16px";
            polygonButton.onclick = function() {
                new L.Draw.Polygon(map, drawControl.options.draw.polygon).enable();
            };

            // Triangle Button (Draw as a Polygon)
            let triangleButton = L.DomUtil.create('a', '', container);
            triangleButton.innerHTML = '▲'; // Triangle icon
            triangleButton.title = "Draw Triangle";
            triangleButton.style.cursor = "pointer";
            triangleButton.style.fontSize = "16px";
            triangleButton.onclick = function() {
                new L.Draw.Polygon(map, {
                    shapeOptions: {
                        color: 'orange',
                    },
                    allowIntersection: false,
                    showArea: true,
                }).enable();
            };

            // Circle Button
            let circleButton = L.DomUtil.create('a', '', container);
            circleButton.innerHTML = '⬤'; // Circle icon
            circleButton.title = "Draw Circle";
            circleButton.style.cursor = "pointer";
            circleButton.style.fontSize = "16px";
            circleButton.onclick = function() {
                new L.Draw.Circle(map, drawControl.options.draw.circle).enable();
            };

            return container;
        };

        // Add custom controls to the map
        customControls.addTo(map);

        // Capture the drawn polygon and save its coordinates
        map.on(L.Draw.Event.CREATED, function(event) {
            alert('Hello world');
            let layer = event.layer;
            drawnItems.clearLayers(); // Allow only one polygon
            drawnItems.addLayer(layer);

            // Extract the coordinates
            let coordinates = layer.toGeoJSON().geometry.coordinates;
            document.getElementById('boundary').value = JSON.stringify(coordinates);
        });

        map.on("click", function(e) {
            alert("Hello world");
        });
    </script>
@endsection
