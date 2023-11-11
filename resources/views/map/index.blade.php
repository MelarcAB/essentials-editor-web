@extends('app')

@section('content')
    <div class="max-w-7xl mx-auto p-4">
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <div id="map">
                    <img name="map" src="{{ asset('graphics/pictures/mapRegion0.png') }}" alt=""
                        width="480px" height="320px" />
                </div>
                <form name="mf" action="javascript:void(null)" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Map Filename (in Graphics/Pictures/):
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="text" name="filename" value="mapRegion0.png" />
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Square width:
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="number" name="sqwidth" min="1" max="16" value="16" />
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Square height:
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="number" name="sqheight" min="1" max="16" value="16" />
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Region Name:
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="text" name="name" value="Sample Region" />
                    </div>

                    <div class="flex items-center justify-between">
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="button" name="btnChange">
                            Change
                        </button>
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="button" name="btnRefresh">
                            Refresh
                        </button>
                    </div>
                </form>

            </div>

            <form name="f" action="javascript:void(null)" class="bg-white shadow-md rounded px-8 pt-6 pb-8">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Current Position:
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" name="curpos" readonly="readonly" />
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Name:
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" name="locname" />
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Point of Interest:
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" name="poi" />
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Fly Destination:
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" name="healing" />
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Switch:
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" name="swtch" />
                </div>

                <div class="mb-4">
                    <input
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="button" name="btnSave" value="Save" disabled="disabled" />
                    <input
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="button" name="btnCancel" value="Cancel" />
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Single section from townmap.txt (without section heading):
                    </label>
                    <textarea
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        name="data" rows="10"></textarea>
                </div>

                <div class="mb-4">
                    <input
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="button" name="btnLoad" value="Load" />
                    <p class="text-sm mt-2">
                        Copy the data above into townmap.txt when you're done.
                    </p>
                </div>
            </form>
        </div>
    </div>




    <script>
        choiceX = -1
        choiceY = -1
        mappoints = []
        mpelements = []

        function target(event) {
            return event.target || event.srcElement
        }

        function addChild(e) {
            if (document.documentElement) {
                document.documentElement.appendChild(e)
            } else {
                document.body.appendChild(e)
            }
        }

        function removeChild(e) {
            if (document.documentElement) {
                document.documentElement.removeChild(e)
            } else {
                document.body.removeChild(e)
            }
        }

        function positionedOffset(element) {
            var valueT = 0,
                valueL = 0;
            do {
                valueT += element.offsetTop || 0;
                valueL += element.offsetLeft || 0;
                element = element.offsetParent;
                if (element) {
                    p = element.style.position;
                    if (p == 'relative' || p == 'absolute') break;
                }
            } while (element);
            return [valueL, valueT];
        }

        function pointerX(event) {
            return event.pageX || (event.clientX +
                (document.documentElement.scrollLeft || document.body.scrollLeft));
        }

        function pointerY(event) {
            return event.pageY || (event.clientY +
                (document.documentElement.scrollTop || document.body.scrollTop));
        }

        function elementPos(event) {
            t = target(event)
            po = positionedOffset(t)
            return [(pointerX(event)) - po[0], (pointerY(event)) - po[1]]
        }

        function elementPosObject(event, other) {
            t = other
            po = positionedOffset(t)
            return [(pointerX(event)) - po[0], (pointerY(event)) - po[1]]
        }

        function attachEvent(element, name, observer, useCapture) {
            if (element.addEventListener) {
                element.addEventListener(name, observer, useCapture || false);
            } else if (element.attachEvent) {
                element.attachEvent('on' + name, observer);
            }
        }

        function qstr(text) {
            var temp;
            temp = text.toString();
            while (true) {
                if (temp == '') return text;
                if (temp.indexOf("'") >= 0) break;
                if (temp.indexOf('"') >= 0) break;
                if (temp.indexOf(' ') >= 0) break;
                if (temp.indexOf(',') >= 0) break;
                return temp;
            }
            //   temp = temp.replace(/\'/g,"''");
            //   temp = temp.replace(/\"/g,"\"\"");
            return temp
            //   return "\"" + temp + "\"";
        }

        function CsvNextToken(dataobj) {
            var i;
            var text;
            var c, n;
            var inside;
            var value;
            var q = '';
            inside = false;
            value = '';
            var skip = false;
            var data = dataobj[0]
            if (data == '') return '';
            text = '';
            for (i = 0; i < data.length; ++i) {
                if (skip) {
                    skip = false;
                    continue;
                }
                c = data.charAt(i);
                n = '';
                if (inside) {
                    if (c == q) {
                        if (i < data.length - 1) n = data.charAt(i + 1);
                        if (n == q) {
                            value = value + c;
                            skip = true;
                            continue;
                        }
                        inside = false;
                        continue;
                    }
                    value = value + c;
                    continue;
                }
                //      if ((c == '"') || (c == "'")){
                //        inside = true;
                //        q = c;
                //        continue;
                //      }
                if (c == ',') break;
                value = value + c;
            }
            if (i >= (data.length - 1)) {
                dataobj[0] = '';
            } else {
                dataobj[0] = data.substr(i + 1);
            }
            dataobj[0] = dataobj[0].replace(/^\s+/, "").replace(/\s+$/, "")
            return value;
        }

        ///////////////////////////
        function loadMapPoints() {
            mappoints = []
            lines = document.f.data.value.split("\n")
            for (var i = 0; i < lines.length; i++) {
                lines[i] = lines[i].replace(/\s+$/, "")
                if (!/^\#/.test(lines[i]) && !/^\s*$/.test(lines[i])) {
                    e = /^\s*(\w+)\s*=\s*(.*)$/.exec(lines[i])
                    if (!e) {
                        alert("Bad line syntax in line " + (i + 1))
                    }
                    if (e[1] == "Filename") {
                        o = document.getElementById("map")
                        o.innerHTML = '<img name="map" src="Graphics/Pictures/' + e[2] +
                            '" alt="" width="480" height="320"/' + '>'
                    } else if (e[1] == "Name") {
                        document.mf.name.value = e[2]
                    } else if (e[1] == "Point") {
                        data = [e[2]]
                        mappt = []
                        mappt[0] = parseInt(CsvNextToken(data), 10)
                        mappt[1] = parseInt(CsvNextToken(data), 10)
                        mappt[2] = CsvNextToken(data)
                        mappt[3] = CsvNextToken(data)
                        mappt[4] = [CsvNextToken(data), CsvNextToken(data), CsvNextToken(data)]
                        mappt[5] = CsvNextToken(data)
                        mappoints[mappoints.length] = mappt
                    }
                }
            }
        }

        function createMapPoint(imgfile, x, y) {
            e = document.createElement("div")
            e.innerHTML = "<img src='" + imgfile + "' alt=''/>"
            e.style.left = elempos[0] + x * document.mf.sqwidth.value + (document.mf.sqwidth.value - 8) / 2
            e.style.top = elempos[1] + y * document.mf.sqheight.value + (document.mf.sqheight.value - 8) / 2
            e.style.position = "absolute"
            attachEvent(e, "mousemove", MapMouseMove)
            attachEvent(e, "click", MapClick)
            return e
        }

        function createMapPoint(color, x, y) {
            var e = document.createElement("div");
            e.style.width = "8px"; // Tamaño del punto
            e.style.height = "8px";
            e.style.backgroundColor = color; // Color del punto
            e.style.borderRadius = "50%"; // Hacerlo redondo
            e.style.position = "absolute";
            e.style.left = elempos[0] + x * document.mf.sqwidth.value + (document.mf.sqwidth.value - 8) / 2 + "px";
            e.style.top = elempos[1] + y * document.mf.sqheight.value + (document.mf.sqheight.value - 8) / 2 + "px";

            attachEvent(e, "mousemove", MapMouseMove);
            attachEvent(e, "click", MapClick);

            return e;
        }

        function showMapPoints() {
            for (var i = 0; i < mpelements.length; i++) {
                removeChild(mpelements[i]);
            }
            mpelements = [];
            elempos = positionedOffset(document.images.map);

            for (var i = 0; i < mappoints.length; i++) {
                var e = createMapPoint("blue", mappoints[i][0], mappoints[i][1]); // Puntos azules para puntos conocidos
                addChild(e);
                mpelements.push(e);
            }

            if (choiceX != -1 || choiceY != -1) {
                var e = createMapPoint("red", choiceX, choiceY); // Punto rojo para la selección
                addChild(e);
                mpelements.push(e);
            }
        }

        function MapMouseMove(e) {
            if (choiceX == -1 && choiceY == -1) {
                elempos = elementPosObject(e, document.getElementById("map"))
                if (elempos[0] >= 0 && elempos[0] < 480 && elempos[1] >= 0 && elempos[1] < 320) {
                    setMapPoint(Math.floor(elempos[0] / document.mf.sqwidth.value),
                        Math.floor(elempos[1] / document.mf.sqheight.value))
                }
            }
        }

        function MapClick(e) {
            console.log("click")
            console.log(e)
            elempos = elementPosObject(e, document.getElementById("map"))
            if (elempos[0] >= 0 && elempos[0] < 480 && elempos[1] >= 0 && elempos[1] < 320) {
                choiceX = Math.floor(elempos[0] / document.mf.sqwidth.value)
                choiceY = Math.floor(elempos[1] / document.mf.sqheight.value)
                setMapPoint(Math.floor(elempos[0] / document.mf.sqwidth.value),
                    Math.floor(elempos[1] / document.mf.sqheight.value))
                document.f.btnSave.disabled = false
                showMapPoints()
            }
        }

        function getbase(fn) {
            if (fn.lastIndexOf("/") >= 0) {
                fn = fn.substr(fn.lastIndexOf("/") + 1)
            }
            if (fn.lastIndexOf("\\") >= 0) {
                fn = fn.substr(fn.lastIndexOf("\\") + 1)
            }
            return fn
        }

        function genMapPoints() {
            ret = ""
            ret += "Filename = " + qstr(getbase(document.images.map.src)) + "\r\n"
            ret += "Name = " + qstr(document.mf.name.value) + "\r\n"
            for (var i = 0; i < mappoints.length; i++) {
                ret += "Point = " + [mappoints[i][0], mappoints[i][1],
                    qstr(mappoints[i][2]), qstr(mappoints[i][3]),
                    mappoints[i][4][0] != null ? mappoints[i][4][0] : "",
                    mappoints[i][4][1] != null ? mappoints[i][4][1] : "",
                    mappoints[i][4][2] != null ? mappoints[i][4][2] : "",
                    mappoints[i][5]
                ] + "\r\n"
            }
            document.f.data.value = ret
            showMapPoints()
        }

        function setMapPoint(x, y) {
            document.f.curpos.value = [x, y]
            for (var i = 0; i < mappoints.length; i++) {
                if (mappoints[i][0] == x && mappoints[i][1] == y) {
                    document.f.locname.value = mappoints[i][2]
                    document.f.poi.value = mappoints[i][3]
                    document.f.healing.value = mappoints[i][4]
                    document.f.swtch.value = mappoints[i][5]
                    return
                }
            }
            document.f.locname.value = ""
            document.f.poi.value = ""
            document.f.healing.value = ""
            document.f.swtch.value = ""
        }

        function addMapPoint(x, y) {
            for (var i = 0; i < mappoints.length; i++) {
                if (mappoints[i][0] == x && mappoints[i][1] == y) {
                    mappoints[i][2] = document.f.locname.value
                    mappoints[i][3] = document.f.poi.value
                    mappoints[i][4] = document.f.healing.value.split(",")
                    mappoints[i][5] = document.f.swtch.value
                    return
                }
            }
            mappoints[mappoints.length] = [x, y,
                document.f.locname.value,
                document.f.poi.value,
                document.f.healing.value.split(","),
                document.f.swtch.value,
            ]
        }

        attachEvent(window, "load", function(e) {
            genMapPoints()
            attachEvent(document.images.map, "mouseout", function(e) {
                if (choiceX == -1 && choiceY == -1) {
                    document.f.curpos.value = ""
                }
            })
            attachEvent(document.getElementById("map"), "mousemove", MapMouseMove)
            attachEvent(document.getElementById("map"), "click", MapClick)
            attachEvent(document.f.btnSave, "click", function(e) {
                if (choiceX != -1 || choiceY != -1) {
                    addMapPoint(choiceX, choiceY)
                    genMapPoints()
                    target(e).disabled = true
                    choiceX = choiceY = -1
                    showMapPoints()
                }
            })
            attachEvent(document.f.btnCancel, "click", function(e) {
                if (choiceX != -1 || choiceY != -1) {
                    setMapPoint(choiceX, choiceY)
                    choiceX = choiceY = -1
                    showMapPoints()
                }
            })
            attachEvent(document.f.btnLoad, "click", function(e) {
                loadMapPoints()
                genMapPoints()
                choiceX = choiceY = -1
                showMapPoints()
            })
            attachEvent(document.mf.btnChange, "click", function(e) {
                document.images.map.src = "Graphics/Pictures/" + document.mf.filename.value
                genMapPoints()
                showMapPoints()
            })
            attachEvent(document.mf.btnChange2, "click", function(e) {
                genMapPoints()
                showMapPoints()
            })
            attachEvent(document.mf.btnRefresh, "click", function(e) {
                choiceX = choiceY = -1
                document.f.curpos.value = ""
                showMapPoints()
            })
        })
    </script>
@endsection
