"use strict";

function InfoBox(e) {
    e = e || {}, google.maps.OverlayView.apply(this, arguments), this.content_ = e.content || "", this.disableAutoPan_ = e.disableAutoPan || !1, this.maxWidth_ = e.maxWidth || 0, this.pixelOffset_ = e.pixelOffset || new google.maps.Size(0, 0), this.position_ = e.position || new google.maps.LatLng(0, 0), this.zIndex_ = e.zIndex || null, this.boxClass_ = e.boxClass || "infoBox", this.boxStyle_ = e.boxStyle || {}, this.closeBoxMargin_ = e.closeBoxMargin || "2px", this.closeBoxURL_ = e.closeBoxURL || "http://www.google.com/intl/en_us/mapfiles/close.gif", "" === e.closeBoxURL && (this.closeBoxURL_ = ""), this.infoBoxClearance_ = e.infoBoxClearance || new google.maps.Size(1, 1), "undefined" == typeof e.visible && ("undefined" == typeof e.isHidden ? e.visible = !0 : e.visible = !e.isHidden), this.isHidden_ = !e.visible, this.alignBottom_ = e.alignBottom || !1, this.pane_ = e.pane || "floatPane", this.enableEventPropagation_ = e.enableEventPropagation || !1, this.div_ = null, this.closeListener_ = null, this.moveListener_ = null, this.contextListener_ = null, this.eventListeners_ = null, this.fixedWidthSet_ = null
}

function inherits(e, t) {
    function o() {}
    o.prototype = t.prototype, e.superClass_ = t.prototype, e.prototype = new o, e.prototype.constructor = e
}

function MarkerLabel_(e, t) {
    this.marker_ = e, this.handCursorURL_ = e.handCursorURL, this.labelDiv_ = document.createElement("div"), this.labelDiv_.style.cssText = "position: absolute; overflow: hidden;", this.eventDiv_ = document.createElement("div"), this.eventDiv_.style.cssText = this.labelDiv_.style.cssText, this.eventDiv_.setAttribute("onselectstart", "return false;"), this.eventDiv_.setAttribute("ondragstart", "return false;"), this.crossDiv_ = MarkerLabel_.getSharedCross(t)
}

function MarkerWithLabel(e) {
    e = e || {}, e.labelContent = e.labelContent || "", e.labelAnchor = e.labelAnchor || new google.maps.Point(0, 0), e.labelClass = e.labelClass || "markerLabels", e.labelStyle = e.labelStyle || {}, e.labelInBackground = e.labelInBackground || !1, "undefined" == typeof e.labelVisible && (e.labelVisible = !0), "undefined" == typeof e.raiseOnDrag && (e.raiseOnDrag = !0), "undefined" == typeof e.clickable && (e.clickable = !0), "undefined" == typeof e.draggable && (e.draggable = !1), "undefined" == typeof e.optimized && (e.optimized = !1), e.crossImage = e.crossImage || "http" + ("https:" === document.location.protocol ? "s" : "") + "://maps.gstatic.com/intl/en_us/mapfiles/drag_cross_67_16.png", e.handCursor = e.handCursor || "http" + ("https:" === document.location.protocol ? "s" : "") + "://maps.gstatic.com/intl/en_us/mapfiles/closedhand_8_8.cur", e.optimized = !1, this.label = new MarkerLabel_(this, e.crossImage, e.handCursor), google.maps.Marker.apply(this, arguments)
}! function(e, t) {
    "object" == typeof exports ? module.exports = t() : "function" == typeof define && define.amd ? define(["jquery", "googlemaps!"], t) : e.GMaps = t()
}(this, function() {
    if ("object" != typeof window.google || !window.google.maps) throw "Google Maps API is required. Please register the following JavaScript library http://maps.google.com/maps/api/js?sensor=true.";
    var t = function(e, t) {
            var o;
            if (e === t) return e;
            for (o in t) e[o] = t[o];
            return e
        },
        o = function(e, t) {
            var o, n = Array.prototype.slice.call(arguments, 2),
                i = [],
                s = e.length;
            if (Array.prototype.map && e.map === Array.prototype.map) i = Array.prototype.map.call(e, function(e) {
                var o = n.slice(0);
                return o.splice(0, 0, e), t.apply(this, o)
            });
            else
                for (o = 0; o < s; o++) callback_params = n, callback_params.splice(0, 0, e[o]), i.push(t.apply(this, callback_params));
            return i
        },
        n = function(e) {
            var t, o = [];
            for (t = 0; t < e.length; t++) o = o.concat(e[t]);
            return o
        },
        i = function(e, t) {
            var o = e[0],
                n = e[1];
            return t && (o = e[1], n = e[0]), new google.maps.LatLng(o, n)
        },
        s = function(e, t) {
            var o;
            for (o = 0; o < e.length; o++) e[o] instanceof google.maps.LatLng || (e[o].length > 0 && "object" == typeof e[o][0] ? e[o] = s(e[o], t) : e[o] = i(e[o], t));
            return e
        },
        a = function(e, t) {
            var o, n = e.replace(".", "");
            return o = "jQuery" in this && t ? $("." + n, t)[0] : document.getElementsByClassName(n)[0]
        },
        r = function(e, t) {
            var o, e = e.replace("#", "");
            return o = "jQuery" in window && t ? $("#" + e, t)[0] : document.getElementById(e)
        },
        l = function(e) {
            var t = 0,
                o = 0;
            if (e.offsetParent)
                do t += e.offsetLeft, o += e.offsetTop; while (e = e.offsetParent);
            return [t, o]
        },
        p = function() {
            var e = document,
                o = function(n) {
                    if (!this) return new o(n);
                    n.zoom = n.zoom || 15, n.mapType = n.mapType || "roadmap";
                    var i, s = function(e, t) {
                            return void 0 === e ? t : e
                        },
                        p = this,
                        g = ["bounds_changed", "center_changed", "click", "dblclick", "drag", "dragend", "dragstart", "idle", "maptypeid_changed", "projection_changed", "resize", "tilesloaded", "zoom_changed"],
                        c = ["mousemove", "mouseout", "mouseover"],
                        h = ["el", "lat", "lng", "mapType", "width", "height", "markerClusterer", "enableNewStyle"],
                        d = n.el || n.div,
                        m = n.markerClusterer,
                        u = google.maps.MapTypeId[n.mapType.toUpperCase()],
                        f = new google.maps.LatLng(n.lat, n.lng),
                        y = s(n.zoomControl, !0),
                        v = n.zoomControlOpt || {
                            style: "DEFAULT",
                            position: "TOP_LEFT"
                        },
                        _ = v.style || "DEFAULT",
                        b = v.position || "TOP_LEFT",
                        k = s(n.panControl, !0),
                        x = s(n.mapTypeControl, !0),
                        w = s(n.scaleControl, !0),
                        L = s(n.streetViewControl, !0),
                        M = s(M, !0),
                        C = {},
                        P = {
                            zoom: this.zoom,
                            center: f,
                            mapTypeId: u
                        },
                        T = {
                            panControl: k,
                            zoomControl: y,
                            zoomControlOptions: {
                                style: google.maps.ZoomControlStyle[_],
                                position: google.maps.ControlPosition[b]
                            },
                            mapTypeControl: x,
                            scaleControl: w,
                            streetViewControl: L,
                            overviewMapControl: M
                        };
                    if ("string" == typeof n.el || "string" == typeof n.div ? d.indexOf("#") > -1 ? this.el = r(d, n.context) : this.el = a.apply(this, [d, n.context]) : this.el = d, "undefined" == typeof this.el || null === this.el) throw "No element defined.";
                    for (window.context_menu = window.context_menu || {}, window.context_menu[p.el.id] = {}, this.controls = [], this.overlays = [], this.layers = [], this.singleLayers = {}, this.markers = [], this.polylines = [], this.routes = [], this.polygons = [], this.infoWindow = null, this.overlay_el = null, this.zoom = n.zoom, this.registered_events = {}, this.el.style.width = n.width || this.el.scrollWidth || this.el.offsetWidth, this.el.style.height = n.height || this.el.scrollHeight || this.el.offsetHeight, google.maps.visualRefresh = n.enableNewStyle, i = 0; i < h.length; i++) delete n[h[i]];
                    for (1 != n.disableDefaultUI && (P = t(P, T)), C = t(P, n), i = 0; i < g.length; i++) delete C[g[i]];
                    for (i = 0; i < c.length; i++) delete C[c[i]];
                    this.map = new google.maps.Map(this.el, C), m && (this.markerClusterer = m.apply(this, [this.map]));
                    var D = function(e, t) {
                        var o = "",
                            n = window.context_menu[p.el.id][e];
                        for (var i in n)
                            if (n.hasOwnProperty(i)) {
                                var s = n[i];
                                o += '<li><a id="' + e + "_" + i + '" href="#">' + s.title + "</a></li>"
                            }
                        if (r("gmaps_context_menu")) {
                            var a = r("gmaps_context_menu");
                            a.innerHTML = o;
                            var i, g = a.getElementsByTagName("a"),
                                c = g.length;
                            for (i = 0; i < c; i++) {
                                var h = g[i],
                                    d = function(o) {
                                        o.preventDefault(), n[this.id.replace(e + "_", "")].action.apply(p, [t]), p.hideContextMenu()
                                    };
                                google.maps.event.clearListeners(h, "click"), google.maps.event.addDomListenerOnce(h, "click", d, !1)
                            }
                            var m = l.apply(this, [p.el]),
                                u = m[0] + t.pixel.x - 15,
                                f = m[1] + t.pixel.y - 15;
                            a.style.left = u + "px", a.style.top = f + "px"
                        }
                    };
                    this.buildContextMenu = function(e, t) {
                        if ("marker" === e) {
                            t.pixel = {};
                            var o = new google.maps.OverlayView;
                            o.setMap(p.map), o.draw = function() {
                                var n = o.getProjection(),
                                    i = t.marker.getPosition();
                                t.pixel = n.fromLatLngToContainerPixel(i), D(e, t)
                            }
                        } else D(e, t);
                        var n = r("gmaps_context_menu");
                        setTimeout(function() {
                            n.style.display = "block"
                        }, 0)
                    }, this.setContextMenu = function(t) {
                        window.context_menu[p.el.id][t.control] = {};
                        var o, n = e.createElement("ul");
                        for (o in t.options)
                            if (t.options.hasOwnProperty(o)) {
                                var i = t.options[o];
                                window.context_menu[p.el.id][t.control][i.name] = {
                                    title: i.title,
                                    action: i.action
                                }
                            }
                        n.id = "gmaps_context_menu", n.style.display = "none", n.style.position = "absolute", n.style.minWidth = "100px", n.style.background = "white", n.style.listStyle = "none", n.style.padding = "8px", n.style.boxShadow = "2px 2px 6px #ccc", r("gmaps_context_menu") || e.body.appendChild(n);
                        var s = r("gmaps_context_menu");
                        google.maps.event.addDomListener(s, "mouseout", function(e) {
                            e.relatedTarget && this.contains(e.relatedTarget) || window.setTimeout(function() {
                                s.style.display = "none"
                            }, 400)
                        }, !1)
                    }, this.hideContextMenu = function() {
                        var e = r("gmaps_context_menu");
                        e && (e.style.display = "none")
                    };
                    var I = function(e, t) {
                        google.maps.event.addListener(e, t, function(e) {
                            void 0 == e && (e = this), n[t].apply(this, [e]), p.hideContextMenu()
                        })
                    };
                    google.maps.event.addListener(this.map, "zoom_changed", this.hideContextMenu);
                    for (var B = 0; B < g.length; B++) {
                        var S = g[B];
                        S in n && I(this.map, S)
                    }
                    for (var B = 0; B < c.length; B++) {
                        var S = c[B];
                        S in n && I(this.map, S)
                    }
                    google.maps.event.addListener(this.map, "rightclick", function(e) {
                        n.rightclick && n.rightclick.apply(this, [e]), void 0 != window.context_menu[p.el.id].map && p.buildContextMenu("map", e)
                    }), this.refresh = function() {
                        google.maps.event.trigger(this.map, "resize")
                    }, this.fitZoom = function() {
                        var e, t = [],
                            o = this.markers.length;
                        for (e = 0; e < o; e++) "boolean" == typeof this.markers[e].visible && this.markers[e].visible && t.push(this.markers[e].getPosition());
                        this.fitLatLngBounds(t)
                    }, this.fitLatLngBounds = function(e) {
                        var t, o = e.length,
                            n = new google.maps.LatLngBounds;
                        for (t = 0; t < o; t++) n.extend(e[t]);
                        this.map.fitBounds(n)
                    }, this.setCenter = function(e, t, o) {
                        this.map.panTo(new google.maps.LatLng(e, t)), o && o()
                    }, this.getElement = function() {
                        return this.el
                    }, this.zoomIn = function(e) {
                        e = e || 1, this.zoom = this.map.getZoom() + e, this.map.setZoom(this.zoom)
                    }, this.zoomOut = function(e) {
                        e = e || 1, this.zoom = this.map.getZoom() - e, this.map.setZoom(this.zoom)
                    };
                    var O, z = [];
                    for (O in this.map) "function" != typeof this.map[O] || this[O] || z.push(O);
                    for (i = 0; i < z.length; i++) ! function(e, t, o) {
                        e[o] = function() {
                            return t[o].apply(t, arguments)
                        }
                    }(this, this.map, z[i])
                };
            return o
        }(this);
    p.prototype.createControl = function(e) {
        var t = document.createElement("div");
        t.style.cursor = "pointer", e.disableDefaultStyles !== !0 && (t.style.fontFamily = "Helvetica, Arial, sans-serif", t.style.fontSize = "11px", t.style.boxShadow = "rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px");
        for (var o in e.style) t.style[o] = e.style[o];
        e.id && (t.id = e.id), e.title && (t.title = e.title), e.classes && (t.className = e.classes), e.content && ("string" == typeof e.content ? t.innerHTML = e.content : e.content instanceof HTMLElement && t.appendChild(e.content)), e.position && (t.position = google.maps.ControlPosition[e.position.toUpperCase()]);
        for (var n in e.events) ! function(t, o) {
            google.maps.event.addDomListener(t, o, function() {
                e.events[o].apply(this, [this])
            })
        }(t, n);
        return t.index = 1, t
    }, p.prototype.addControl = function(e) {
        var t = this.createControl(e);
        return this.controls.push(t), this.map.controls[t.position].push(t), t
    }, p.prototype.removeControl = function(e) {
        var t, o = null;
        for (t = 0; t < this.controls.length; t++) this.controls[t] == e && (o = this.controls[t].position, this.controls.splice(t, 1));
        if (o)
            for (t = 0; t < this.map.controls.length; t++) {
                var n = this.map.controls[e.position];
                if (n.getAt(t) == e) {
                    n.removeAt(t);
                    break
                }
            }
        return e
    }, p.prototype.createMarker = function(e) {
        if (void 0 == e.lat && void 0 == e.lng && void 0 == e.position) throw "No latitude or longitude defined.";
        var o = this,
            n = e.details,
            i = e.fences,
            s = e.outside,
            a = {
                position: new google.maps.LatLng(e.lat, e.lng),
                map: null
            },
            r = t(a, e);
        delete r.lat, delete r.lng, delete r.fences, delete r.outside;
        var l = new google.maps.Marker(r);
        if (l.fences = i, e.infoWindow) {
            l.infoWindow = new google.maps.InfoWindow(e.infoWindow);
            for (var p = ["closeclick", "content_changed", "domready", "position_changed", "zindex_changed"], g = 0; g < p.length; g++) ! function(t, o) {
                e.infoWindow[o] && google.maps.event.addListener(t, o, function(t) {
                    e.infoWindow[o].apply(this, [t])
                })
            }(l.infoWindow, p[g])
        }
        for (var c = ["animation_changed", "clickable_changed", "cursor_changed", "draggable_changed", "flat_changed", "icon_changed", "position_changed", "shadow_changed", "shape_changed", "title_changed", "visible_changed", "zindex_changed"], h = ["dblclick", "drag", "dragend", "dragstart", "mousedown", "mouseout", "mouseover", "mouseup"], g = 0; g < c.length; g++) ! function(t, o) {
            e[o] && google.maps.event.addListener(t, o, function() {
                e[o].apply(this, [this])
            })
        }(l, c[g]);
        for (var g = 0; g < h.length; g++) ! function(t, o, n) {
            e[n] && google.maps.event.addListener(o, n, function(o) {
                o.pixel || (o.pixel = t.getProjection().fromLatLngToPoint(o.latLng)), e[n].apply(this, [o])
            })
        }(this.map, l, h[g]);
        return google.maps.event.addListener(l, "click", function() {
            this.details = n, e.click && e.click.apply(this, [this]), l.infoWindow && (o.hideInfoWindows(), l.infoWindow.open(o.map, l))
        }), google.maps.event.addListener(l, "rightclick", function(t) {
            t.marker = this, e.rightclick && e.rightclick.apply(this, [t]), void 0 != window.context_menu[o.el.id].marker && o.buildContextMenu("marker", t)
        }), l.fences && google.maps.event.addListener(l, "dragend", function() {
            o.checkMarkerGeofence(l, function(e, t) {
                s(e, t)
            })
        }), l
    }, p.prototype.addMarker = function(e) {
        var t;
        if (e.hasOwnProperty("gm_accessors_")) t = e;
        else {
            if (!(e.hasOwnProperty("lat") && e.hasOwnProperty("lng") || e.position)) throw "No latitude or longitude defined.";
            t = this.createMarker(e)
        }
        return t.setMap(this.map), this.markerClusterer && this.markerClusterer.addMarker(t), this.markers.push(t), p.fire("marker_added", t, this), t
    }, p.prototype.addMarkers = function(e) {
        for (var t, o = 0; t = e[o]; o++) this.addMarker(t);
        return this.markers
    }, p.prototype.hideInfoWindows = function() {
        for (var e, t = 0; e = this.markers[t]; t++) e.infoWindow && e.infoWindow.close()
    }, p.prototype.removeMarker = function(e) {
        for (var t = 0; t < this.markers.length; t++)
            if (this.markers[t] === e) {
                this.markers[t].setMap(null), this.markers.splice(t, 1), this.markerClusterer && this.markerClusterer.removeMarker(e), p.fire("marker_removed", e, this);
                break
            }
        return e
    }, p.prototype.removeMarkers = function(e) {
        var t = [];
        if ("undefined" == typeof e) {
            for (var o = 0; o < this.markers.length; o++) {
                var n = this.markers[o];
                n.setMap(null), this.markerClusterer && this.markerClusterer.removeMarker(n), p.fire("marker_removed", n, this)
            }
            this.markers = t
        } else {
            for (var o = 0; o < e.length; o++) {
                var i = this.markers.indexOf(e[o]);
                if (i > -1) {
                    var n = this.markers[i];
                    n.setMap(null), this.markerClusterer && this.markerClusterer.removeMarker(n), p.fire("marker_removed", n, this)
                }
            }
            for (var o = 0; o < this.markers.length; o++) {
                var n = this.markers[o];
                null != n.getMap() && t.push(n)
            }
            this.markers = t
        }
    }, p.prototype.drawOverlay = function(e) {
        var t = new google.maps.OverlayView,
            o = !0;
        return t.setMap(this.map), null != e.auto_show && (o = e.auto_show), t.onAdd = function() {
            var o = document.createElement("div");
            o.style.borderStyle = "none", o.style.borderWidth = "0px", o.style.position = "absolute", o.style.zIndex = 100, o.innerHTML = e.content, t.el = o, e.layer || (e.layer = "overlayLayer");
            var n = this.getPanes(),
                i = n[e.layer],
                s = ["contextmenu", "DOMMouseScroll", "dblclick", "mousedown"];
            i.appendChild(o);
            for (var a = 0; a < s.length; a++) ! function(e, t) {
                google.maps.event.addDomListener(e, t, function(e) {
                    navigator.userAgent.toLowerCase().indexOf("msie") != -1 && document.all ? (e.cancelBubble = !0, e.returnValue = !1) : e.stopPropagation()
                })
            }(o, s[a]);
            e.click && (n.overlayMouseTarget.appendChild(t.el), google.maps.event.addDomListener(t.el, "click", function() {
                e.click.apply(t, [t])
            })), google.maps.event.trigger(this, "ready")
        }, t.draw = function() {
            var n = this.getProjection(),
                i = n.fromLatLngToDivPixel(new google.maps.LatLng(e.lat, e.lng));
            e.horizontalOffset = e.horizontalOffset || 0, e.verticalOffset = e.verticalOffset || 0;
            var s = t.el,
                a = s.children[0],
                r = a.clientHeight,
                l = a.clientWidth;
            switch (e.verticalAlign) {
                case "top":
                    s.style.top = i.y - r + e.verticalOffset + "px";
                    break;
                default:
                case "middle":
                    s.style.top = i.y - r / 2 + e.verticalOffset + "px";
                    break;
                case "bottom":
                    s.style.top = i.y + e.verticalOffset + "px"
            }
            switch (e.horizontalAlign) {
                case "left":
                    s.style.left = i.x - l + e.horizontalOffset + "px";
                    break;
                default:
                case "center":
                    s.style.left = i.x - l / 2 + e.horizontalOffset + "px";
                    break;
                case "right":
                    s.style.left = i.x + e.horizontalOffset + "px"
            }
            s.style.display = o ? "block" : "none", o || e.show.apply(this, [s])
        }, t.onRemove = function() {
            var o = t.el;
            e.remove ? e.remove.apply(this, [o]) : (t.el.parentNode.removeChild(t.el), t.el = null)
        }, this.overlays.push(t), t
    }, p.prototype.removeOverlay = function(e) {
        for (var t = 0; t < this.overlays.length; t++)
            if (this.overlays[t] === e) {
                this.overlays[t].setMap(null), this.overlays.splice(t, 1);
                break
            }
    }, p.prototype.removeOverlays = function() {
        for (var e, t = 0; e = this.overlays[t]; t++) e.setMap(null);
        this.overlays = []
    }, p.prototype.drawPolyline = function(e) {
        var t = [],
            o = e.path;
        if (o.length)
            if (void 0 === o[0][0]) t = o;
            else
                for (var n, i = 0; n = o[i]; i++) t.push(new google.maps.LatLng(n[0], n[1]));
        var s = {
            map: this.map,
            path: t,
            strokeColor: e.strokeColor,
            strokeOpacity: e.strokeOpacity,
            strokeWeight: e.strokeWeight,
            geodesic: e.geodesic,
            clickable: !0,
            editable: !1,
            visible: !0
        };
        e.hasOwnProperty("clickable") && (s.clickable = e.clickable), e.hasOwnProperty("editable") && (s.editable = e.editable), e.hasOwnProperty("icons") && (s.icons = e.icons), e.hasOwnProperty("zIndex") && (s.zIndex = e.zIndex);
        for (var a = new google.maps.Polyline(s), r = ["click", "dblclick", "mousedown", "mousemove", "mouseout", "mouseover", "mouseup", "rightclick"], l = 0; l < r.length; l++) ! function(t, o) {
            e[o] && google.maps.event.addListener(t, o, function(t) {
                e[o].apply(this, [t])
            })
        }(a, r[l]);
        return this.polylines.push(a), p.fire("polyline_added", a, this), a
    }, p.prototype.removePolyline = function(e) {
        for (var t = 0; t < this.polylines.length; t++)
            if (this.polylines[t] === e) {
                this.polylines[t].setMap(null), this.polylines.splice(t, 1), p.fire("polyline_removed", e, this);
                break
            }
    }, p.prototype.removePolylines = function() {
        for (var e, t = 0; e = this.polylines[t]; t++) e.setMap(null);
        this.polylines = []
    }, p.prototype.drawCircle = function(e) {
        e = t({
            map: this.map,
            center: new google.maps.LatLng(e.lat, e.lng)
        }, e), delete e.lat, delete e.lng;
        for (var o = new google.maps.Circle(e), n = ["click", "dblclick", "mousedown", "mousemove", "mouseout", "mouseover", "mouseup", "rightclick"], i = 0; i < n.length; i++) ! function(t, o) {
            e[o] && google.maps.event.addListener(t, o, function(t) {
                e[o].apply(this, [t])
            })
        }(o, n[i]);
        return this.polygons.push(o), o
    }, p.prototype.drawRectangle = function(e) {
        e = t({
            map: this.map
        }, e);
        var o = new google.maps.LatLngBounds(new google.maps.LatLng(e.bounds[0][0], e.bounds[0][1]), new google.maps.LatLng(e.bounds[1][0], e.bounds[1][1]));
        e.bounds = o;
        for (var n = new google.maps.Rectangle(e), i = ["click", "dblclick", "mousedown", "mousemove", "mouseout", "mouseover", "mouseup", "rightclick"], s = 0; s < i.length; s++) ! function(t, o) {
            e[o] && google.maps.event.addListener(t, o, function(t) {
                e[o].apply(this, [t])
            })
        }(n, i[s]);
        return this.polygons.push(n), n
    }, p.prototype.drawPolygon = function(e) {
        var i = !1;
        e.hasOwnProperty("useGeoJSON") && (i = e.useGeoJSON), delete e.useGeoJSON, e = t({
            map: this.map
        }, e), 0 == i && (e.paths = [e.paths.slice(0)]), e.paths.length > 0 && e.paths[0].length > 0 && (e.paths = n(o(e.paths, s, i)));
        for (var a = new google.maps.Polygon(e), r = ["click", "dblclick", "mousedown", "mousemove", "mouseout", "mouseover", "mouseup", "rightclick"], l = 0; l < r.length; l++) ! function(t, o) {
            e[o] && google.maps.event.addListener(t, o, function(t) {
                e[o].apply(this, [t])
            })
        }(a, r[l]);
        return this.polygons.push(a), p.fire("polygon_added", a, this), a
    }, p.prototype.removePolygon = function(e) {
        for (var t = 0; t < this.polygons.length; t++)
            if (this.polygons[t] === e) {
                this.polygons[t].setMap(null), this.polygons.splice(t, 1), p.fire("polygon_removed", e, this);
                break
            }
    }, p.prototype.removePolygons = function() {
        for (var e, t = 0; e = this.polygons[t]; t++) e.setMap(null);
        this.polygons = []
    }, p.prototype.getFromFusionTables = function(e) {
        var t = e.events;
        delete e.events;
        var o = e,
            n = new google.maps.FusionTablesLayer(o);
        for (var i in t) ! function(e, o) {
            google.maps.event.addListener(e, o, function(e) {
                t[o].apply(this, [e])
            })
        }(n, i);
        return this.layers.push(n), n
    }, p.prototype.loadFromFusionTables = function(e) {
        var t = this.getFromFusionTables(e);
        return t.setMap(this.map), t
    }, p.prototype.getFromKML = function(e) {
        var t = e.url,
            o = e.events;
        delete e.url, delete e.events;
        var n = e,
            i = new google.maps.KmlLayer(t, n);
        for (var s in o) ! function(e, t) {
            google.maps.event.addListener(e, t, function(e) {
                o[t].apply(this, [e])
            })
        }(i, s);
        return this.layers.push(i), i
    }, p.prototype.loadFromKML = function(e) {
        var t = this.getFromKML(e);
        return t.setMap(this.map), t
    }, p.prototype.addLayer = function(e, t) {
        t = t || {};
        var o;
        switch (e) {
            case "weather":
                this.singleLayers.weather = o = new google.maps.weather.WeatherLayer;
                break;
            case "clouds":
                this.singleLayers.clouds = o = new google.maps.weather.CloudLayer;
                break;
            case "traffic":
                this.singleLayers.traffic = o = new google.maps.TrafficLayer;
                break;
            case "transit":
                this.singleLayers.transit = o = new google.maps.TransitLayer;
                break;
            case "bicycling":
                this.singleLayers.bicycling = o = new google.maps.BicyclingLayer;
                break;
            case "panoramio":
                this.singleLayers.panoramio = o = new google.maps.panoramio.PanoramioLayer, o.setTag(t.filter), delete t.filter, t.click && google.maps.event.addListener(o, "click", function(e) {
                    t.click(e), delete t.click
                });
                break;
            case "places":
                if (this.singleLayers.places = o = new google.maps.places.PlacesService(this.map), t.search || t.nearbySearch || t.radarSearch) {
                    var n = {
                        bounds: t.bounds || null,
                        keyword: t.keyword || null,
                        location: t.location || null,
                        name: t.name || null,
                        radius: t.radius || null,
                        rankBy: t.rankBy || null,
                        types: t.types || null
                    };
                    t.radarSearch && o.radarSearch(n, t.radarSearch), t.search && o.search(n, t.search), t.nearbySearch && o.nearbySearch(n, t.nearbySearch)
                }
                if (t.textSearch) {
                    var i = {
                        bounds: t.bounds || null,
                        location: t.location || null,
                        query: t.query || null,
                        radius: t.radius || null
                    };
                    o.textSearch(i, t.textSearch)
                }
        }
        if (void 0 !== o) return "function" == typeof o.setOptions && o.setOptions(t), "function" == typeof o.setMap && o.setMap(this.map), o
    }, p.prototype.removeLayer = function(e) {
        if ("string" == typeof e && void 0 !== this.singleLayers[e]) this.singleLayers[e].setMap(null), delete this.singleLayers[e];
        else
            for (var t = 0; t < this.layers.length; t++)
                if (this.layers[t] === e) {
                    this.layers[t].setMap(null), this.layers.splice(t, 1);
                    break
                }
    };
    var g, c;
    return p.prototype.getRoutes = function(e) {
        switch (e.travelMode) {
            case "bicycling":
                g = google.maps.TravelMode.BICYCLING;
                break;
            case "transit":
                g = google.maps.TravelMode.TRANSIT;
                break;
            case "driving":
                g = google.maps.TravelMode.DRIVING;
                break;
            default:
                g = google.maps.TravelMode.WALKING
        }
        c = "imperial" === e.unitSystem ? google.maps.UnitSystem.IMPERIAL : google.maps.UnitSystem.METRIC;
        var o = {
                avoidHighways: !1,
                avoidTolls: !1,
                optimizeWaypoints: !1,
                waypoints: []
            },
            n = t(o, e);
        n.origin = /string/.test(typeof e.origin) ? e.origin : new google.maps.LatLng(e.origin[0], e.origin[1]), n.destination = /string/.test(typeof e.destination) ? e.destination : new google.maps.LatLng(e.destination[0], e.destination[1]), n.travelMode = g, n.unitSystem = c, delete n.callback, delete n.error;
        var i = this,
            s = new google.maps.DirectionsService;
        s.route(n, function(t, o) {
            if (o === google.maps.DirectionsStatus.OK) {
                for (var n in t.routes) t.routes.hasOwnProperty(n) && i.routes.push(t.routes[n]);
                e.callback && e.callback(i.routes)
            } else e.error && e.error(t, o)
        })
    }, p.prototype.removeRoutes = function() {
        this.routes = []
    }, p.prototype.getElevations = function(e) {
        e = t({
            locations: [],
            path: !1,
            samples: 256
        }, e), e.locations.length > 0 && e.locations[0].length > 0 && (e.locations = n(o([e.locations], s, !1)));
        var i = e.callback;
        delete e.callback;
        var a = new google.maps.ElevationService;
        if (e.path) {
            var r = {
                path: e.locations,
                samples: e.samples
            };
            a.getElevationAlongPath(r, function(e, t) {
                i && "function" == typeof i && i(e, t)
            })
        } else delete e.path, delete e.samples, a.getElevationForLocations(e, function(e, t) {
            i && "function" == typeof i && i(e, t)
        })
    }, p.prototype.cleanRoute = p.prototype.removePolylines, p.prototype.drawRoute = function(e) {
        var t = this;
        this.getRoutes({
            origin: e.origin,
            destination: e.destination,
            travelMode: e.travelMode,
            waypoints: e.waypoints,
            unitSystem: e.unitSystem,
            error: e.error,
            callback: function(o) {
                if (o.length > 0) {
                    var n = {
                        path: o[o.length - 1].overview_path,
                        strokeColor: e.strokeColor,
                        strokeOpacity: e.strokeOpacity,
                        strokeWeight: e.strokeWeight
                    };
                    e.hasOwnProperty("icons") && (n.icons = e.icons), t.drawPolyline(n), e.callback && e.callback(o[o.length - 1])
                }
            }
        })
    }, p.prototype.travelRoute = function(e) {
        if (e.origin && e.destination) this.getRoutes({
            origin: e.origin,
            destination: e.destination,
            travelMode: e.travelMode,
            waypoints: e.waypoints,
            unitSystem: e.unitSystem,
            error: e.error,
            callback: function(t) {
                if (t.length > 0 && e.start && e.start(t[t.length - 1]), t.length > 0 && e.step) {
                    var o = t[t.length - 1];
                    if (o.legs.length > 0)
                        for (var n, i = o.legs[0].steps, s = 0; n = i[s]; s++) n.step_number = s, e.step(n, o.legs[0].steps.length - 1)
                }
                t.length > 0 && e.end && e.end(t[t.length - 1])
            }
        });
        else if (e.route && e.route.legs.length > 0)
            for (var t, o = e.route.legs[0].steps, n = 0; t = o[n]; n++) t.step_number = n, e.step(t)
    }, p.prototype.drawSteppedRoute = function(e) {
        var t = this;
        if (e.origin && e.destination) this.getRoutes({
            origin: e.origin,
            destination: e.destination,
            travelMode: e.travelMode,
            waypoints: e.waypoints,
            error: e.error,
            callback: function(o) {
                if (o.length > 0 && e.start && e.start(o[o.length - 1]), o.length > 0 && e.step) {
                    var n = o[o.length - 1];
                    if (n.legs.length > 0)
                        for (var i, s = n.legs[0].steps, a = 0; i = s[a]; a++) {
                            i.step_number = a;
                            var r = {
                                path: i.path,
                                strokeColor: e.strokeColor,
                                strokeOpacity: e.strokeOpacity,
                                strokeWeight: e.strokeWeight
                            };
                            e.hasOwnProperty("icons") && (r.icons = e.icons), t.drawPolyline(r), e.step(i, n.legs[0].steps.length - 1)
                        }
                }
                o.length > 0 && e.end && e.end(o[o.length - 1])
            }
        });
        else if (e.route && e.route.legs.length > 0)
            for (var o, n = e.route.legs[0].steps, i = 0; o = n[i]; i++) {
                o.step_number = i;
                var s = {
                    path: o.path,
                    strokeColor: e.strokeColor,
                    strokeOpacity: e.strokeOpacity,
                    strokeWeight: e.strokeWeight
                };
                e.hasOwnProperty("icons") && (s.icons = e.icons), t.drawPolyline(s), e.step(o)
            }
    }, p.Route = function(e) {
        this.origin = e.origin, this.destination = e.destination, this.waypoints = e.waypoints, this.map = e.map, this.route = e.route, this.step_count = 0, this.steps = this.route.legs[0].steps, this.steps_length = this.steps.length;
        var t = {
            path: new google.maps.MVCArray,
            strokeColor: e.strokeColor,
            strokeOpacity: e.strokeOpacity,
            strokeWeight: e.strokeWeight
        };
        e.hasOwnProperty("icons") && (t.icons = e.icons), this.polyline = this.map.drawPolyline(t).getPath()
    }, p.Route.prototype.getRoute = function(t) {
        var o = this;
        this.map.getRoutes({
            origin: this.origin,
            destination: this.destination,
            travelMode: t.travelMode,
            waypoints: this.waypoints || [],
            error: t.error,
            callback: function() {
                o.route = e[0], t.callback && t.callback.call(o)
            }
        })
    }, p.Route.prototype.back = function() {
        if (this.step_count > 0) {
            this.step_count--;
            var e = this.route.legs[0].steps[this.step_count].path;
            for (var t in e) e.hasOwnProperty(t) && this.polyline.pop()
        }
    }, p.Route.prototype.forward = function() {
        if (this.step_count < this.steps_length) {
            var e = this.route.legs[0].steps[this.step_count].path;
            for (var t in e) e.hasOwnProperty(t) && this.polyline.push(e[t]);
            this.step_count++
        }
    }, p.prototype.checkGeofence = function(e, t, o) {
        return o.containsLatLng(new google.maps.LatLng(e, t))
    }, p.prototype.checkMarkerGeofence = function(e, t) {
        if (e.fences)
            for (var o, n = 0; o = e.fences[n]; n++) {
                var i = e.getPosition();
                this.checkGeofence(i.lat(), i.lng(), o) || t(e, o)
            }
    }, p.prototype.toImage = function(e) {
        var e = e || {},
            t = {};
        if (t.size = e.size || [this.el.clientWidth, this.el.clientHeight], t.lat = this.getCenter().lat(), t.lng = this.getCenter().lng(), this.markers.length > 0) {
            t.markers = [];
            for (var o = 0; o < this.markers.length; o++) t.markers.push({
                lat: this.markers[o].getPosition().lat(),
                lng: this.markers[o].getPosition().lng()
            })
        }
        if (this.polylines.length > 0) {
            var n = this.polylines[0];
            t.polyline = {}, t.polyline.path = google.maps.geometry.encoding.encodePath(n.getPath()), t.polyline.strokeColor = n.strokeColor, t.polyline.strokeOpacity = n.strokeOpacity, t.polyline.strokeWeight = n.strokeWeight
        }
        return p.staticMapURL(t)
    }, p.staticMapURL = function(e) {
        function t(e, t) {
            if ("#" === e[0] && (e = e.replace("#", "0x"), t)) {
                if (t = parseFloat(t), t = Math.min(1, Math.max(t, 0)), 0 === t) return "0x00000000";
                t = (255 * t).toString(16), 1 === t.length && (t += t), e = e.slice(0, 8) + t
            }
            return e
        }
        var o, n = [],
            i = ("file:" === location.protocol ? "http:" : location.protocol) + "//maps.googleapis.com/maps/api/staticmap";
        e.url && (i = e.url, delete e.url), i += "?";
        var s = e.markers;
        delete e.markers, !s && e.marker && (s = [e.marker], delete e.marker);
        var a = e.styles;
        delete e.styles;
        var r = e.polyline;
        if (delete e.polyline, e.center) n.push("center=" + e.center), delete e.center;
        else if (e.address) n.push("center=" + e.address), delete e.address;
        else if (e.lat) n.push(["center=", e.lat, ",", e.lng].join("")), delete e.lat, delete e.lng;
        else if (e.visible) {
            var l = encodeURI(e.visible.join("|"));
            n.push("visible=" + l)
        }
        var p = e.size;
        p ? (p.join && (p = p.join("x")), delete e.size) : p = "630x300", n.push("size=" + p), e.zoom || e.zoom === !1 || (e.zoom = 15);
        var g = !e.hasOwnProperty("sensor") || !!e.sensor;
        delete e.sensor, n.push("sensor=" + g);
        for (var c in e) e.hasOwnProperty(c) && n.push(c + "=" + e[c]);
        if (s)
            for (var h, d, m = 0; o = s[m]; m++) {
                h = [], o.size && "normal" !== o.size ? (h.push("size:" + o.size), delete o.size) : o.icon && (h.push("icon:" + encodeURI(o.icon)), delete o.icon), o.color && (h.push("color:" + o.color.replace("#", "0x")), delete o.color), o.label && (h.push("label:" + o.label[0].toUpperCase()), delete o.label), d = o.address ? o.address : o.lat + "," + o.lng, delete o.address, delete o.lat, delete o.lng;
                for (var c in o) o.hasOwnProperty(c) && h.push(c + ":" + o[c]);
                h.length || 0 === m ? (h.push(d), h = h.join("|"), n.push("markers=" + encodeURI(h))) : (h = n.pop() + encodeURI("|" + d), n.push(h))
            }
        if (a)
            for (var m = 0; m < a.length; m++) {
                var u = [];
                a[m].featureType && u.push("feature:" + a[m].featureType.toLowerCase()), a[m].elementType && u.push("element:" + a[m].elementType.toLowerCase());
                for (var f = 0; f < a[m].stylers.length; f++)
                    for (var y in a[m].stylers[f]) {
                        var v = a[m].stylers[f][y];
                        "hue" != y && "color" != y || (v = "0x" + v.substring(1)), u.push(y + ":" + v)
                    }
                var _ = u.join("|");
                "" != _ && n.push("style=" + _)
            }
        if (r) {
            if (o = r, r = [], o.strokeWeight && r.push("weight:" + parseInt(o.strokeWeight, 10)), o.strokeColor) {
                var b = t(o.strokeColor, o.strokeOpacity);
                r.push("color:" + b)
            }
            if (o.fillColor) {
                var k = t(o.fillColor, o.fillOpacity);
                r.push("fillcolor:" + k)
            }
            var x = o.path;
            if (x.join)
                for (var w, f = 0; w = x[f]; f++) r.push(w.join(","));
            else r.push("enc:" + x);
            r = r.join("|"), n.push("path=" + encodeURI(r))
        }
        var L = window.devicePixelRatio || 1;
        return n.push("scale=" + L), n = n.join("&"), i + n
    }, p.prototype.addMapType = function(e, t) {
        if (!t.hasOwnProperty("getTileUrl") || "function" != typeof t.getTileUrl) throw "'getTileUrl' function required.";
        t.tileSize = t.tileSize || new google.maps.Size(256, 256);
        var o = new google.maps.ImageMapType(t);
        this.map.mapTypes.set(e, o)
    }, p.prototype.addOverlayMapType = function(e) {
        if (!e.hasOwnProperty("getTile") || "function" != typeof e.getTile) throw "'getTile' function required.";
        var t = e.index;
        delete e.index, this.map.overlayMapTypes.insertAt(t, e)
    }, p.prototype.removeOverlayMapType = function(e) {
        this.map.overlayMapTypes.removeAt(e)
    }, p.prototype.addStyle = function(e) {
        var t = new google.maps.StyledMapType(e.styles, {
            name: e.styledMapName
        });
        this.map.mapTypes.set(e.mapTypeId, t)
    }, p.prototype.setStyle = function(e) {
        this.map.setMapTypeId(e)
    }, p.prototype.createPanorama = function(e) {
        return e.hasOwnProperty("lat") && e.hasOwnProperty("lng") || (e.lat = this.getCenter().lat(), e.lng = this.getCenter().lng()), this.panorama = p.createPanorama(e), this.map.setStreetView(this.panorama), this.panorama
    }, p.createPanorama = function(e) {
        var o = r(e.el, e.context);
        e.position = new google.maps.LatLng(e.lat, e.lng), delete e.el, delete e.context, delete e.lat, delete e.lng;
        for (var n = ["closeclick", "links_changed", "pano_changed", "position_changed", "pov_changed", "resize", "visible_changed"], i = t({
                visible: !0
            }, e), s = 0; s < n.length; s++) delete i[n[s]];
        for (var a = new google.maps.StreetViewPanorama(o, i), s = 0; s < n.length; s++) ! function(t, o) {
            e[o] && google.maps.event.addListener(t, o, function() {
                e[o].apply(this)
            })
        }(a, n[s]);
        return a
    }, p.prototype.on = function(e, t) {
        return p.on(e, this, t)
    }, p.prototype.off = function(e) {
        p.off(e, this)
    }, p.custom_events = ["marker_added", "marker_removed", "polyline_added", "polyline_removed", "polygon_added", "polygon_removed", "geolocated", "geolocation_failed"], p.on = function(e, t, o) {
        if (p.custom_events.indexOf(e) == -1) return t instanceof p && (t = t.map), google.maps.event.addListener(t, e, o);
        var n = {
            handler: o,
            eventName: e
        };
        return t.registered_events[e] = t.registered_events[e] || [], t.registered_events[e].push(n), n
    }, p.off = function(e, t) {
        p.custom_events.indexOf(e) == -1 ? (t instanceof p && (t = t.map), google.maps.event.clearListeners(t, e)) : t.registered_events[e] = []
    }, p.fire = function(e, t, o) {
        if (p.custom_events.indexOf(e) == -1) google.maps.event.trigger(t, e, Array.prototype.slice.apply(arguments).slice(2));
        else if (e in o.registered_events)
            for (var n = o.registered_events[e], i = 0; i < n.length; i++) ! function(e, t, o) {
                e.apply(t, [o])
            }(n[i].handler, o, t)
    }, p.geolocate = function(e) {
        var t = e.always || e.complete;
        navigator.geolocation ? navigator.geolocation.getCurrentPosition(function(o) {
            e.success(o), t && t()
        }, function(o) {
            e.error(o), t && t()
        }, e.options) : (e.not_supported(), t && t())
    }, p.geocode = function(e) {
        this.geocoder = new google.maps.Geocoder;
        var t = e.callback;
        e.hasOwnProperty("lat") && e.hasOwnProperty("lng") && (e.latLng = new google.maps.LatLng(e.lat, e.lng)), delete e.lat, delete e.lng, delete e.callback, this.geocoder.geocode(e, function(e, o) {
            t(e, o)
        })
    }, google.maps.Polygon.prototype.getBounds || (google.maps.Polygon.prototype.getBounds = function() {
        for (var e, t = new google.maps.LatLngBounds, o = this.getPaths(), n = 0; n < o.getLength(); n++) {
            e = o.getAt(n);
            for (var i = 0; i < e.getLength(); i++) t.extend(e.getAt(i))
        }
        return t
    }), google.maps.Polygon.prototype.containsLatLng || (google.maps.Polygon.prototype.containsLatLng = function(e) {
        var t = this.getBounds();
        if (null !== t && !t.contains(e)) return !1;
        for (var o = !1, n = this.getPaths().getLength(), i = 0; i < n; i++)
            for (var s = this.getPaths().getAt(i), a = s.getLength(), r = a - 1, l = 0; l < a; l++) {
                var p = s.getAt(l),
                    g = s.getAt(r);
                (p.lng() < e.lng() && g.lng() >= e.lng() || g.lng() < e.lng() && p.lng() >= e.lng()) && p.lat() + (e.lng() - p.lng()) / (g.lng() - p.lng()) * (g.lat() - p.lat()) < e.lat() && (o = !o), r = l
            }
        return o
    }), google.maps.Circle.prototype.containsLatLng || (google.maps.Circle.prototype.containsLatLng = function(e) {
        return !google.maps.geometry || google.maps.geometry.spherical.computeDistanceBetween(this.getCenter(), e) <= this.getRadius()
    }), google.maps.LatLngBounds.prototype.containsLatLng = function(e) {
        return this.contains(e)
    }, google.maps.Marker.prototype.setFences = function(e) {
        this.fences = e
    }, google.maps.Marker.prototype.addFence = function(e) {
        this.fences.push(e)
    }, google.maps.Marker.prototype.getId = function() {
        return this.__gm_id
    }, Array.prototype.indexOf || (Array.prototype.indexOf = function(e) {
        if (null == this) throw new TypeError;
        var t = Object(this),
            o = t.length >>> 0;
        if (0 === o) return -1;
        var n = 0;
        if (arguments.length > 1 && (n = Number(arguments[1]), n != n ? n = 0 : 0 != n && n != 1 / 0 && n != -(1 / 0) && (n = (n > 0 || -1) * Math.floor(Math.abs(n)))), n >= o) return -1;
        for (var i = n >= 0 ? n : Math.max(o - Math.abs(n), 0); i < o; i++)
            if (i in t && t[i] === e) return i;
        return -1
    }), p
});
var options = {
        zoom: 14,
        mapTypeId: "ZITA",
        disableDefaultUI: !0,
        zoomControl: !0,
        mapTypeControl: !0,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
            position: google.maps.ControlPosition.RIGHT_TOP,
            mapTypeIds: ["ZITA", "satellite", "hybrid"]
        },
        zoomControlOptions: {
            position: google.maps.ControlPosition.RIGHT_BOTTOM
        }
    },
    styles = [{
        featureType: "landscape.man_made",
        elementType: "geometry",
        stylers: [{
            color: "#f7f1df"
        }, {
            lightness: 1
        }]
    }, {
        featureType: "landscape.natural",
        elementType: "geometry",
        stylers: [{
            color: "#d0e3b4"
        }, {
            lightness: 20
        }]
    }, {
        featureType: "landscape.natural.terrain",
        elementType: "geometry",
        stylers: [{
            visibility: "on"
        }]
    }, {
        featureType: "poi",
        elementType: "labels",
        stylers: [{
            visibility: "on"
        }]
    }, {
        featureType: "poi.business",
        elementType: "all",
        stylers: [{
            visibility: "on"
        }]
    }, {
        featureType: "poi.medical",
        elementType: "geometry",
        stylers: [{
            color: "#fbd3da"
        }]
    }, {
        featureType: "poi.park",
        elementType: "geometry",
        stylers: [{
            color: "#bde6ab"
        }]
    }, {
        featureType: "road",
        elementType: "geometry.stroke",
        stylers: [{
            visibility: "off"
        }]
    }, {
        featureType: "road",
        elementType: "labels",
        stylers: [{
            visibility: "on"
        }]
    }, {
        featureType: "road.highway",
        elementType: "geometry.fill",
        stylers: [{
            color: "#ffe15f"
        }]
    }, {
        featureType: "road.highway",
        elementType: "geometry.stroke",
        stylers: [{
            color: "#efd151"
        }]
    }, {
        featureType: "road.arterial",
        elementType: "geometry.fill",
        stylers: [{
            color: "#ffffff"
        }]
    }, {
        featureType: "road.local",
        elementType: "geometry.fill",
        stylers: [{
            color: "black"
        }]
    }];
InfoBox.prototype = new google.maps.OverlayView, InfoBox.prototype.createInfoBoxDiv_ = function() {
        var e, t, o, n = this,
            i = function(e) {
                e.cancelBubble = !0, e.stopPropagation && e.stopPropagation()
            },
            s = function(e) {
                e.returnValue = !1, e.preventDefault && e.preventDefault(), n.enableEventPropagation_ || i(e)
            };
        if (!this.div_) {
            if (this.div_ = document.createElement("div"), this.setBoxStyle_(), "undefined" == typeof this.content_.nodeType ? this.div_.innerHTML = this.getCloseBoxImg_() + this.content_ : (this.div_.innerHTML = this.getCloseBoxImg_(), this.div_.appendChild(this.content_)), this.getPanes()[this.pane_].appendChild(this.div_), this.addClickHandler_(), this.div_.style.width ? this.fixedWidthSet_ = !0 : 0 !== this.maxWidth_ && this.div_.offsetWidth > this.maxWidth_ ? (this.div_.style.width = this.maxWidth_, this.div_.style.overflow = "auto", this.fixedWidthSet_ = !0) : (o = this.getBoxWidths_(), this.div_.style.width = this.div_.offsetWidth - o.left - o.right + "px", this.fixedWidthSet_ = !1), this.panBox_(this.disableAutoPan_), !this.enableEventPropagation_) {
                for (this.eventListeners_ = [], t = ["mousedown", "mouseover", "mouseout", "mouseup", "click", "dblclick", "touchstart", "touchend", "touchmove"], e = 0; e < t.length; e++) this.eventListeners_.push(google.maps.event.addDomListener(this.div_, t[e], i));
                this.eventListeners_.push(google.maps.event.addDomListener(this.div_, "mouseover", function() {
                    this.style.cursor = "default"
                }))
            }
            this.contextListener_ = google.maps.event.addDomListener(this.div_, "contextmenu", s), google.maps.event.trigger(this, "domready")
        }
    }, InfoBox.prototype.getCloseBoxImg_ = function() {
        var e = "";
        return "" !== this.closeBoxURL_ && (e = "<img", e += " src='" + this.closeBoxURL_ + "'", e += " align=right", e += " style='", e += " position: relative;", e += " cursor: pointer;", e += " margin: " + this.closeBoxMargin_ + ";", e += "'>"), e
    }, InfoBox.prototype.addClickHandler_ = function() {
        var e;
        "" !== this.closeBoxURL_ ? (e = this.div_.firstChild, this.closeListener_ = google.maps.event.addDomListener(e, "click", this.getCloseClickHandler_())) : this.closeListener_ = null
    }, InfoBox.prototype.getCloseClickHandler_ = function() {
        var e = this;
        return function(t) {
            t.cancelBubble = !0, t.stopPropagation && t.stopPropagation(), google.maps.event.trigger(e, "closeclick"), e.close()
        }
    }, InfoBox.prototype.panBox_ = function(e) {
        var t, o, n = 0,
            i = 0;
        if (!e && (t = this.getMap(), t instanceof google.maps.Map)) {
            t.getBounds().contains(this.position_) || t.setCenter(this.position_), o = t.getBounds();
            var s = t.getDiv(),
                a = s.offsetWidth,
                r = s.offsetHeight,
                l = this.pixelOffset_.width,
                p = this.pixelOffset_.height,
                g = this.div_.offsetWidth,
                c = this.div_.offsetHeight,
                h = this.infoBoxClearance_.width,
                d = this.infoBoxClearance_.height,
                m = this.getProjection().fromLatLngToContainerPixel(this.position_);
            if (m.x < -l + h ? n = m.x + l - h : m.x + g + l + h > a && (n = m.x + g + l + h - a), this.alignBottom_ ? m.y < -p + d + c ? i = m.y + p - d - c : m.y + p + d > r && (i = m.y + p + d - r) : m.y < -p + d ? i = m.y + p - d : m.y + c + p + d > r && (i = m.y + c + p + d - r), 0 !== n || 0 !== i) {
                t.getCenter();
                t.panBy(n, i)
            }
        }
    }, InfoBox.prototype.setBoxStyle_ = function() {
        var e, t;
        if (this.div_) {
            this.div_.className = this.boxClass_, this.div_.style.cssText = "", t = this.boxStyle_;
            for (e in t) t.hasOwnProperty(e) && (this.div_.style[e] = t[e]);
            this.div_.style.WebkitTransform = "translateZ(0)", "undefined" != typeof this.div_.style.opacity && "" !== this.div_.style.opacity && (this.div_.style.MsFilter = '"progid:DXImageTransform.Microsoft.Alpha(Opacity=' + 100 * this.div_.style.opacity + ')"', this.div_.style.filter = "alpha(opacity=" + 100 * this.div_.style.opacity + ")"), this.div_.style.position = "absolute", this.div_.style.visibility = "hidden", null !== this.zIndex_ && (this.div_.style.zIndex = this.zIndex_)
        }
    }, InfoBox.prototype.getBoxWidths_ = function() {
        var e, t = {
                top: 0,
                bottom: 0,
                left: 0,
                right: 0
            },
            o = this.div_;
        return document.defaultView && document.defaultView.getComputedStyle ? (e = o.ownerDocument.defaultView.getComputedStyle(o, ""), e && (t.top = parseInt(e.borderTopWidth, 10) || 0, t.bottom = parseInt(e.borderBottomWidth, 10) || 0, t.left = parseInt(e.borderLeftWidth, 10) || 0, t.right = parseInt(e.borderRightWidth, 10) || 0)) : document.documentElement.currentStyle && o.currentStyle && (t.top = parseInt(o.currentStyle.borderTopWidth, 10) || 0, t.bottom = parseInt(o.currentStyle.borderBottomWidth, 10) || 0, t.left = parseInt(o.currentStyle.borderLeftWidth, 10) || 0, t.right = parseInt(o.currentStyle.borderRightWidth, 10) || 0), t
    }, InfoBox.prototype.onRemove = function() {
        this.div_ && (this.div_.parentNode.removeChild(this.div_), this.div_ = null)
    }, InfoBox.prototype.draw = function() {
        this.createInfoBoxDiv_();
        var e = this.getProjection().fromLatLngToDivPixel(this.position_);
        this.div_.style.left = e.x + this.pixelOffset_.width + "px", this.alignBottom_ ? this.div_.style.bottom = -(e.y + this.pixelOffset_.height) + "px" : this.div_.style.top = e.y + this.pixelOffset_.height + "px", this.isHidden_ ? this.div_.style.visibility = "hidden" : this.div_.style.visibility = "visible"
    }, InfoBox.prototype.setOptions = function(e) {
        "undefined" != typeof e.boxClass && (this.boxClass_ = e.boxClass, this.setBoxStyle_()), "undefined" != typeof e.boxStyle && (this.boxStyle_ = e.boxStyle, this.setBoxStyle_()), "undefined" != typeof e.content && this.setContent(e.content), "undefined" != typeof e.disableAutoPan && (this.disableAutoPan_ = e.disableAutoPan), "undefined" != typeof e.maxWidth && (this.maxWidth_ = e.maxWidth), "undefined" != typeof e.pixelOffset && (this.pixelOffset_ = e.pixelOffset), "undefined" != typeof e.alignBottom && (this.alignBottom_ = e.alignBottom), "undefined" != typeof e.position && this.setPosition(e.position), "undefined" != typeof e.zIndex && this.setZIndex(e.zIndex), "undefined" != typeof e.closeBoxMargin && (this.closeBoxMargin_ = e.closeBoxMargin), "undefined" != typeof e.closeBoxURL && (this.closeBoxURL_ = e.closeBoxURL), "undefined" != typeof e.infoBoxClearance && (this.infoBoxClearance_ = e.infoBoxClearance), "undefined" != typeof e.isHidden && (this.isHidden_ = e.isHidden), "undefined" != typeof e.visible && (this.isHidden_ = !e.visible), "undefined" != typeof e.enableEventPropagation && (this.enableEventPropagation_ = e.enableEventPropagation), this.div_ && this.draw()
    }, InfoBox.prototype.setContent = function(e) {
        this.content_ = e, this.div_ && (this.closeListener_ && (google.maps.event.removeListener(this.closeListener_), this.closeListener_ = null), this.fixedWidthSet_ || (this.div_.style.width = ""), "undefined" == typeof e.nodeType ? this.div_.innerHTML = this.getCloseBoxImg_() + e : (this.div_.innerHTML = this.getCloseBoxImg_(), this.div_.appendChild(e)), this.fixedWidthSet_ || (this.div_.style.width = this.div_.offsetWidth + "px", "undefined" == typeof e.nodeType ? this.div_.innerHTML = this.getCloseBoxImg_() + e : (this.div_.innerHTML = this.getCloseBoxImg_(), this.div_.appendChild(e))), this.addClickHandler_()), google.maps.event.trigger(this, "content_changed")
    }, InfoBox.prototype.setPosition = function(e) {
        this.position_ = e, this.div_ && this.draw(), google.maps.event.trigger(this, "position_changed")
    }, InfoBox.prototype.setZIndex = function(e) {
        this.zIndex_ = e, this.div_ && (this.div_.style.zIndex = e), google.maps.event.trigger(this, "zindex_changed")
    }, InfoBox.prototype.setVisible = function(e) {
        this.isHidden_ = !e, this.div_ && (this.div_.style.visibility = this.isHidden_ ? "hidden" : "visible")
    }, InfoBox.prototype.getContent = function() {
        return this.content_
    }, InfoBox.prototype.getPosition = function() {
        return this.position_
    }, InfoBox.prototype.getZIndex = function() {
        return this.zIndex_
    }, InfoBox.prototype.getVisible = function() {
        var e;
        return e = "undefined" != typeof this.getMap() && null !== this.getMap() && !this.isHidden_
    }, InfoBox.prototype.show = function() {
        this.isHidden_ = !1, this.div_ && (this.div_.style.visibility = "visible")
    }, InfoBox.prototype.hide = function() {
        this.isHidden_ = !0, this.div_ && (this.div_.style.visibility = "hidden")
    }, InfoBox.prototype.open = function(e, t) {
        var o = this;
        t && (this.position_ = t.getPosition(), this.moveListener_ = google.maps.event.addListener(t, "position_changed", function() {
            o.setPosition(this.getPosition())
        })), this.setMap(e), this.div_ && this.panBox_()
    }, InfoBox.prototype.close = function() {
        var e;
        if (this.closeListener_ && (google.maps.event.removeListener(this.closeListener_), this.closeListener_ = null), this.eventListeners_) {
            for (e = 0; e < this.eventListeners_.length; e++) google.maps.event.removeListener(this.eventListeners_[e]);
            this.eventListeners_ = null
        }
        this.moveListener_ && (google.maps.event.removeListener(this.moveListener_), this.moveListener_ = null), this.contextListener_ && (google.maps.event.removeListener(this.contextListener_), this.contextListener_ = null), this.setMap(null)
    }, inherits(MarkerLabel_, google.maps.OverlayView), MarkerLabel_.getSharedCross = function(e) {
        var t;
        return "undefined" == typeof MarkerLabel_.getSharedCross.crossDiv && (t = document.createElement("img"), t.style.cssText = "position: absolute; display: none;", t.style.marginLeft = "-8px", t.style.marginTop = "-9px", t.src = e, MarkerLabel_.getSharedCross.crossDiv = t), MarkerLabel_.getSharedCross.crossDiv
    }, MarkerLabel_.prototype.onAdd = function() {
        var e, t, o, n, i, s, a, r = this,
            l = !1,
            p = !1,
            g = 20,
            c = "url(" + this.handCursorURL_ + ")",
            h = function(e) {
                e.preventDefault && e.preventDefault(), e.cancelBubble = !0, e.stopPropagation && e.stopPropagation()
            },
            d = function() {
                r.marker_.setAnimation(null)
            };
        this.getPanes().markerLayer.appendChild(this.labelDiv_), this.getPanes().overlayMouseTarget.appendChild(this.eventDiv_), "undefined" == typeof MarkerLabel_.getSharedCross.processed && (this.getPanes().overlayImage.appendChild(this.crossDiv_), MarkerLabel_.getSharedCross.processed = !0), this.listeners_ = [google.maps.event.addDomListener(this.eventDiv_, "mouseover", function(e) {
            (r.marker_.getDraggable() || r.marker_.getClickable()) && (this.style.cursor = "pointer", google.maps.event.trigger(r.marker_, "mouseover", e))
        }), google.maps.event.addDomListener(this.eventDiv_, "mouseout", function(e) {
            !r.marker_.getDraggable() && !r.marker_.getClickable() || p || (this.style.cursor = r.marker_.getCursor(), google.maps.event.trigger(r.marker_, "mouseout", e))
        }), google.maps.event.addDomListener(this.eventDiv_, "mousedown", function(e) {
            p = !1, r.marker_.getDraggable() && (l = !0, this.style.cursor = c), (r.marker_.getDraggable() || r.marker_.getClickable()) && (google.maps.event.trigger(r.marker_, "mousedown", e), h(e))
        }), google.maps.event.addDomListener(document, "mouseup", function(t) {
            var o;
            if (l && (l = !1, r.eventDiv_.style.cursor = "pointer", google.maps.event.trigger(r.marker_, "mouseup", t)), p) {
                if (i) {
                    o = r.getProjection().fromLatLngToDivPixel(r.marker_.getPosition()), o.y += g, r.marker_.setPosition(r.getProjection().fromDivPixelToLatLng(o));
                    try {
                        r.marker_.setAnimation(google.maps.Animation.BOUNCE), setTimeout(d, 1406)
                    } catch (e) {}
                }
                r.crossDiv_.style.display = "none", r.marker_.setZIndex(e), n = !0, p = !1, t.latLng = r.marker_.getPosition(), google.maps.event.trigger(r.marker_, "dragend", t)
            }
        }), google.maps.event.addListener(r.marker_.getMap(), "mousemove", function(n) {
            var c;
            l && (p ? (n.latLng = new google.maps.LatLng(n.latLng.lat() - t, n.latLng.lng() - o), c = r.getProjection().fromLatLngToDivPixel(n.latLng), i && (r.crossDiv_.style.left = c.x + "px", r.crossDiv_.style.top = c.y + "px", r.crossDiv_.style.display = "", c.y -= g), r.marker_.setPosition(r.getProjection().fromDivPixelToLatLng(c)), i && (r.eventDiv_.style.top = c.y + g + "px"), google.maps.event.trigger(r.marker_, "drag", n)) : (t = n.latLng.lat() - r.marker_.getPosition().lat(), o = n.latLng.lng() - r.marker_.getPosition().lng(), e = r.marker_.getZIndex(), s = r.marker_.getPosition(), a = r.marker_.getMap().getCenter(), i = r.marker_.get("raiseOnDrag"), p = !0, r.marker_.setZIndex(1e6), n.latLng = r.marker_.getPosition(), google.maps.event.trigger(r.marker_, "dragstart", n)))
        }), google.maps.event.addDomListener(document, "keydown", function(e) {
            p && 27 === e.keyCode && (i = !1, r.marker_.setPosition(s), r.marker_.getMap().setCenter(a), google.maps.event.trigger(document, "mouseup", e))
        }), google.maps.event.addDomListener(this.eventDiv_, "click", function(e) {
            (r.marker_.getDraggable() || r.marker_.getClickable()) && (n ? n = !1 : (google.maps.event.trigger(r.marker_, "click", e), h(e)))
        }), google.maps.event.addDomListener(this.eventDiv_, "dblclick", function(e) {
            (r.marker_.getDraggable() || r.marker_.getClickable()) && (google.maps.event.trigger(r.marker_, "dblclick", e), h(e))
        }), google.maps.event.addListener(this.marker_, "dragstart", function() {
            p || (i = this.get("raiseOnDrag"))
        }), google.maps.event.addListener(this.marker_, "drag", function() {
            p || i && (r.setPosition(g), r.labelDiv_.style.zIndex = 1e6 + (this.get("labelInBackground") ? -1 : 1))
        }), google.maps.event.addListener(this.marker_, "dragend", function() {
            p || i && r.setPosition(0)
        }), google.maps.event.addListener(this.marker_, "position_changed", function() {
            r.setPosition()
        }), google.maps.event.addListener(this.marker_, "zindex_changed", function() {
            r.setZIndex()
        }), google.maps.event.addListener(this.marker_, "visible_changed", function() {
            r.setVisible()
        }), google.maps.event.addListener(this.marker_, "labelvisible_changed", function() {
            r.setVisible()
        }), google.maps.event.addListener(this.marker_, "title_changed", function() {
            r.setTitle()
        }), google.maps.event.addListener(this.marker_, "labelcontent_changed", function() {
            r.setContent()
        }), google.maps.event.addListener(this.marker_, "labelanchor_changed", function() {
            r.setAnchor()
        }), google.maps.event.addListener(this.marker_, "labelclass_changed", function() {
            r.setStyles()
        }), google.maps.event.addListener(this.marker_, "labelstyle_changed", function() {
            r.setStyles()
        })]
    }, MarkerLabel_.prototype.onRemove = function() {
        var e;
        for (this.labelDiv_.parentNode.removeChild(this.labelDiv_), this.eventDiv_.parentNode.removeChild(this.eventDiv_), e = 0; e < this.listeners_.length; e++) google.maps.event.removeListener(this.listeners_[e])
    }, MarkerLabel_.prototype.draw = function() {
        this.setContent(), this.setTitle(), this.setStyles()
    }, MarkerLabel_.prototype.setContent = function() {
        var e = this.marker_.get("labelContent");
        "undefined" == typeof e.nodeType ? (this.labelDiv_.innerHTML = e, this.eventDiv_.innerHTML = this.labelDiv_.innerHTML) : (this.labelDiv_.innerHTML = "", this.labelDiv_.appendChild(e), e = e.cloneNode(!0), this.eventDiv_.innerHTML = "", this.eventDiv_.appendChild(e))
    }, MarkerLabel_.prototype.setTitle = function() {
        this.eventDiv_.title = this.marker_.getTitle() || ""
    }, MarkerLabel_.prototype.setStyles = function() {
        var e, t;
        this.labelDiv_.className = this.marker_.get("labelClass"), this.eventDiv_.className = this.labelDiv_.className, this.labelDiv_.style.cssText = "", this.eventDiv_.style.cssText = "", t = this.marker_.get("labelStyle");
        for (e in t) t.hasOwnProperty(e) && (this.labelDiv_.style[e] = t[e], this.eventDiv_.style[e] = t[e]);
        this.setMandatoryStyles()
    }, MarkerLabel_.prototype.setMandatoryStyles = function() {
        this.labelDiv_.style.position = "absolute", this.labelDiv_.style.overflow = "hidden", "undefined" != typeof this.labelDiv_.style.opacity && "" !== this.labelDiv_.style.opacity && (this.labelDiv_.style.MsFilter = '"progid:DXImageTransform.Microsoft.Alpha(opacity=' + 100 * this.labelDiv_.style.opacity + ')"', this.labelDiv_.style.filter = "alpha(opacity=" + 100 * this.labelDiv_.style.opacity + ")"), this.eventDiv_.style.position = this.labelDiv_.style.position, this.eventDiv_.style.overflow = this.labelDiv_.style.overflow, this.eventDiv_.style.opacity = .01, this.eventDiv_.style.MsFilter = '"progid:DXImageTransform.Microsoft.Alpha(opacity=1)"', this.eventDiv_.style.filter = "alpha(opacity=1)", this.setAnchor(), this.setPosition(), this.setVisible()
    }, MarkerLabel_.prototype.setAnchor = function() {
        var e = this.marker_.get("labelAnchor");
        this.labelDiv_.style.marginLeft = -e.x + "px", this.labelDiv_.style.marginTop = -e.y + "px", this.eventDiv_.style.marginLeft = -e.x + "px", this.eventDiv_.style.marginTop = -e.y + "px"
    }, MarkerLabel_.prototype.setPosition = function(e) {
        var t = this.getProjection().fromLatLngToDivPixel(this.marker_.getPosition());
        "undefined" == typeof e && (e = 0), this.labelDiv_.style.left = Math.round(t.x) + "px", this.labelDiv_.style.top = Math.round(t.y - e) + "px", this.eventDiv_.style.left = this.labelDiv_.style.left, this.eventDiv_.style.top = this.labelDiv_.style.top, this.setZIndex()
    }, MarkerLabel_.prototype.setZIndex = function() {
        var e = this.marker_.get("labelInBackground") ? -1 : 1;
        "undefined" == typeof this.marker_.getZIndex() ? (this.labelDiv_.style.zIndex = parseInt(this.labelDiv_.style.top, 10) + e, this.eventDiv_.style.zIndex = this.labelDiv_.style.zIndex) : (this.labelDiv_.style.zIndex = this.marker_.getZIndex() + e, this.eventDiv_.style.zIndex = this.labelDiv_.style.zIndex)
    }, MarkerLabel_.prototype.setVisible = function() {
        this.marker_.get("labelVisible") ? this.labelDiv_.style.display = this.marker_.getVisible() ? "block" : "none" : this.labelDiv_.style.display = "none", this.eventDiv_.style.display = this.labelDiv_.style.display
    }, inherits(MarkerWithLabel, google.maps.Marker), MarkerWithLabel.prototype.setMap = function(e) {
        google.maps.Marker.prototype.setMap.apply(this, arguments), this.label.setMap(e)
    },
    function() {
        function e(e) {
            this.set("fontFamily", "sans-serif"), this.set("fontSize", 12), this.set("fontColor", "#000000"), this.set("strokeWeight", 4), this.set("strokeColor", "#ffffff"), this.set("align", "center"), this.set("zIndex", 1e3), this.setValues(e)
        }

        function t(e) {
            var t = e.a;
            if (t) {
                var o = t.style;
                o.zIndex = e.get("zIndex");
                var n = t.getContext("2d");
                n.clearRect(0, 0, t.width, t.height), n.strokeStyle = e.get("strokeColor"), n.fillStyle = e.get("fontColor"), n.font = e.get("fontSize") + "px " + e.get("fontFamily");
                var t = Number(e.get("strokeWeight")),
                    i = e.get("text");
                if (i) {
                    t && (n.lineWidth = t, n.strokeText(i, t, t)), n.fillText(i, t, t);
                    e: {
                        switch (n = n.measureText(i).width + t, e.get("align")) {
                            case "left":
                                e = 0;
                                break e;
                            case "right":
                                e = -n;
                                break e
                        }
                        e = n / -2
                    }
                    o.marginLeft = e + "px", o.marginTop = "-0.4em"
                }
            }
        }
        var o = "prototype";
        e.prototype = new google.maps.OverlayView, window.MapLabel = e, e[o].changed = function(e) {
            switch (e) {
                case "fontFamily":
                case "fontSize":
                case "fontColor":
                case "strokeWeight":
                case "strokeColor":
                case "align":
                case "text":
                    return t(this);
                case "maxZoom":
                case "minZoom":
                case "position":
                    return this.draw()
            }
        }, e[o].onAdd = function() {
            var e = this.a = document.createElement("canvas");
            e.style.position = "absolute";
            var o = e.getContext("2d");
            o.lineJoin = "round", o.textBaseline = "top", t(this), (o = this.getPanes()) && o.mapPane.appendChild(e)
        }, e[o].onAdd = e[o].onAdd, e[o].draw = function() {
            var e = this.getProjection();
            if (e && this.a) {
                var t = this.get("position");
                if (t) {
                    t = e.fromLatLngToDivPixel(t), e = this.a.style, e.top = t.y + "px", e.left = t.x + "px";
                    var t = this.get("minZoom"),
                        o = this.get("maxZoom");
                    if (void 0 === t && void 0 === o) t = "";
                    else {
                        var n = this.getMap();
                        n ? (n = n.getZoom(), t = n < t || n > o ? "hidden" : "") : t = ""
                    }
                    e.visibility = t
                }
            }
        }, e[o].draw = e[o].draw, e[o].onRemove = function() {
            var e = this.a;
            e && e.parentNode && e.parentNode.removeChild(e)
        }, e[o].onRemove = e[o].onRemove
    }();
var mapLabel, featuresData, featureOverHandler = function(e, t, o) {
        new google.maps.LatLng(o.feature.getProperty("center_lat"), o.feature.getProperty("center_lng"));
        mapLabel ? (mapLabel.set("text", o.feature.getProperty("name")), mapLabel.set("zIndex", 12e5), mapLabel.set("position", o.latLng)) : mapLabel = new MapLabel({
            text: o.feature.getProperty("name"),
            position: o.latLng,
            map: mymap.map,
            fontSize: 25,
            strokeWeight: 5,
            align: "center",
            zIndex: 12e5
        })
    },
    featureOutHandler = function(e) {
        e.revertStyle()
    },
    featureClickHandler = function(e, t, o) {
        var n = t.feature.getProperty("type") + "_s",
            i = t.feature.getProperty("slug");
        o && o(n, i, search_type, search_type_filter, obs)
    },
    loadMapFeature = function(e, t) {
        var o;
        "country" == t.geo_type ? o = "/api/provinces.json" : "province" == t.geo_type ? (o = "/api/provinces/{province}/districts.json", o = o.replace("{province}", t.province)) : "district" == t.geo_type ? (o = t.no_ward ? "/api/provinces/{province}/districts/{district}.json" : "/api/provinces/{province}/districts/{district}/wards.json", o = o.replace("{province}", t.province).replace("{district}", t.district)) : "ward" == t.geo_type && (o = "/api/provinces/{province}/districts/{district}/wards/{ward}.json", o = o.replace("{province}", t.province).replace("{district}", t.district).replace("{ward}", t.ward)), $.ajax({
            type: "GET",
            dataType: "json",
            url: o,
            success: function(o) {
                currentData && currentData.setMap(null), display_feature ? (currentData = new google.maps.Data, currentData.setMap(e.map), currentData.setStyle(dataStyle), featuresData = currentData.addGeoJson(o.geo), o.center && (e.setCenter(o.center.lat, o.center.lng), e.setZoom(search_zoom)), currentData.addListener("mouseover", function(e) {
                    featureOverHandler(currentData, t.geo_type, e)
                }), currentData.addListener("mouseout", function(e) {
                    featureOutHandler(currentData, e)
                })) : e.setCenter(o.center.lat, o.center.lng)
            }
        })
    },
    search_location = function(e, t, o, n, i) {
        var s = $("<form />").attr({
            action: "/tim-kiem-nha-dat",
            method: "get",
            "data-push": "partial",
            "data-target": "#resultPropertyList"
        }).append($("<input />").attr({
            name: e,
            value: t,
            type: "hidden"
        }), $("<input />").attr({
            name: "ads_type",
            value: o,
            type: "hidden"
        }), $("<input />").attr({
            name: "prop_type",
            value: n,
            type: "hidden"
        }));
        "" != i && s.append($("<input />").attr({
            name: "obs",
            value: i,
            type: "hidden"
        })), $("body").append(s), s.submit()
    },
    search_project_location = function(e, t, o) {
        if ("ward_s" != e) {
            var n = $("<form />").attr({
                action: "/tim-kiem-du-an",
                method: "get",
                "data-push": "partial",
                "data-target": "#resultProjList"
            }).append($("<input />").attr({
                name: e,
                value: t,
                type: "hidden"
            }), $("<input />").attr({
                name: "project_type",
                value: o,
                type: "hidden"
            }));
            $("body").append(n), n.submit()
        }
    },
    enableMarkersWithLabel = function(e) {
        e.length > 0 && $.each(e, function(e, t) {
            t.labelVisible || (t.labelVisible = !0)
        })
    },
    disableMarkersWithLabel = function(e) {
        e.length > 0 && $.each(e, function(e, t) {
            t.labelVisible && (t.labelVisible = !1)
        })
    },
    priceDecorate = function(e) {
        if (e) return e.toLowerCase().replace("tr/th\xe1ng", "tr/t").replace("tri\u1ec7u/m2/th\xe1ng", "tr/m/t").replace("ngh\xecn/m2/th\xe1ng", "ng/m/t").replace("tr/m2/th\xe1ng", "tr/m/t").replace("tr/m\xb2", "tr").replace("tri\u1ec7u/m\xb2", "tr").replace("tri\u1ec7u/m2", "tr").replace("tri\u1ec7u/th\xe1ng", "tr/t").replace("ng/th\xe1ng", "ng/t").replace("tri\u1ec7u", "tr").replace("th\u1ecfa thu\u1eadn", "TT")
    },
    propDecorate = function(e) {
        return e.toLowerCase().replace("b\xe1n", "").replace("chung c\u01b0", "").replace("cho thu\xea", "thu\xea").replace(", ph\xf2ng tr\u1ecd", "").replace(", nh\xe0 x\u01b0\u1edfng, \u0111\u1ea5t", "").replace("b\u1ea5t \u0111\u1ed9ng s\u1ea3n", "b\u0111s").replace("- khu ngh\u1ec9 d\u01b0\u1ee1ng", "")
    },
    setPropInfoContent = function(e, t, o) {
        return '<div class="infobox"><strong>' + priceDecorate(e) + "</strong> - " + t + "<br/>" + propDecorate(o) + "<br/></div>"
    },
    tdMarker, tdMarkerInit = function(e) {
        var t = {
                lat: 10.794624,
                lng: 106.722739,
                lnglat: !0,
                title: "Thanh Do Leasing"
            },
            o = e.map.getZoom() >= 14 ? new google.maps.Size(64, 64) : new google.maps.Size(48, 48),
            n = e.map.getZoom() > 14 ? new google.maps.Point(32, 32) : new google.maps.Point(24, 24);
        tdMarker = e.addMarker({
            lat: t.lat,
            lng: t.lng,
            title: t.title,
            icon: new google.maps.MarkerImage("/images/thanh_do/map_logo.png", o, null, n, o),
            draggable: !1,
            animation: google.maps.Animation.DROP
        }), google.maps.event.addListener(tdMarker, "click", function() {
            location = "/thanh-do-leasing-vinhomes-central-park"
        })
    },
    vxMarker, vxMarkerInit = function(e) {
        var t = {
                lat: 10.872224,
                lng: 106.677225,
                lnglat: !0,
                title: "\u0110\u1ecba \u1ed0c V\u1ea1n Xu\u1eadn"
            },
            o = e.map.getZoom() >= 14 ? new google.maps.Size(64, 64) : new google.maps.Size(48, 48),
            n = e.map.getZoom() > 14 ? new google.maps.Point(32, 32) : new google.maps.Point(24, 24);
        vxMarker = e.addMarker({
            lat: t.lat,
            lng: t.lng,
            title: t.title,
            icon: new google.maps.MarkerImage("/images/pins_logo/logoVanXuan.png", o, null, n, o),
            draggable: !1,
            animation: google.maps.Animation.DROP
        }), google.maps.event.addListener(vxMarker, "click", function() {
            window.open("http://www.diaocvanxuan.com.vn/", "_blank")
        })
    },
    hbMarker, hbMarkerInit = function(e) {
        var t = {
                lat: 10.759942,
                lng: 106.699546,
                lnglat: !0,
                title: "H\xf2a B\xecnh House"
            },
            o = e.map.getZoom() >= 14 ? new google.maps.Size(64, 64) : new google.maps.Size(48, 48),
            n = e.map.getZoom() > 14 ? new google.maps.Point(32, 32) : new google.maps.Point(24, 24);
        hbMarker = e.addMarker({
            lat: t.lat,
            lng: t.lng,
            title: t.title,
            icon: new google.maps.MarkerImage("/images/pins_logo/pinHoaBinh.png", o, null, n, o),
            draggable: !1,
            animation: google.maps.Animation.DROP
        }), google.maps.event.addListener(hbMarker, "click", function() {
            window.open("/hoa-binh-house-tong-quan", "_blank")
        })
    },
    places_markers_init = function(e, t) {
        tdMarkerInit(e), vxMarkerInit(e), hbMarkerInit(e), google.maps.event.addListener(e.map, "zoom_changed", function() {
            var o = this.getZoom() >= 14 ? new google.maps.Size(72, 72) : new google.maps.Size(48, 48),
                n = this.getZoom() > 14 ? new google.maps.Point(36, 36) : new google.maps.Point(24, 24);
            vxMarker.setIcon(new google.maps.MarkerImage("/images/pins_logo/logoVanXuan.png", o, null, n, o)), tdMarker.setIcon(new google.maps.MarkerImage("/images/thanh_do/map_logo.png", o, null, n, o)), hbMarker.setIcon(new google.maps.MarkerImage("/images/pins_logo/pinHoaBinh.png", o, null, n, o)), this.getZoom() >= 15 ? enableMarkersWithLabel(t) : disableMarkersWithLabel(t);
            var i = e.getZoom();
            search_zoom = i
        })
    },
    infobox_init = function() {
        infobox = new InfoBox({
            maxWidth: 130,
            pixelOffset: new google.maps.Size(-61, -80),
            zIndex: null,
            boxStyle: {
                opacity: .8,
                width: "130px",
                "text-align": "left"
            },
            closeBoxMargin: "28px 26px 0px 0px",
            closeBoxURL: "",
            infoBoxClearance: new google.maps.Size(1, 1),
            pane: "floatPane",
            enableEventPropagation: !1,
            disableAutoPan: !0
        }), infoboxProvince = new InfoBox({
            maxWidth: 80,
            pixelOffset: new google.maps.Size(-40, -48),
            zIndex: null,
            boxStyle: {
                opacity: .8,
                width: "80px",
                "text-align": "center"
            },
            closeBoxMargin: "28px 26px 0px 0px",
            closeBoxURL: "",
            infoBoxClearance: new google.maps.Size(1, 1),
            pane: "floatPane",
            enableEventPropagation: !1,
            disableAutoPan: !0
        }), infoProps = new InfoBox({
            maxWidth: 150,
            pixelOffset: new google.maps.Size(-46, -52),
            zIndex: null,
            boxStyle: {
                opacity: .8,
                width: "150px",
                "text-align": "left"
            },
            closeBoxMargin: "28px 26px 0px 0px",
            closeBoxURL: "",
            infoBoxClearance: new google.maps.Size(1, 1),
            pane: "floatPane",
            enableEventPropagation: !1,
            disableAutoPan: !0
        });
        for (var e = 1; e <= 10; e++) {
            var t = e > 9 ? "9p" : e,
                o = new google.maps.MarkerImage("/images/numbers/number_" + t + "_gray.png", null, null, null, new google.maps.Size(20, 20)),
                n = new google.maps.MarkerImage("/images/numbers/number_" + t + "_gold.png", null, null, null, new google.maps.Size(20, 20)),
                i = new google.maps.MarkerImage("/images/numbers/number_" + t + "_red.png", null, null, null, new google.maps.Size(20, 20));
            icons.push(o), iconGolds.push(n), iconHovers.push(i)
        }
    },
    CenterControl = function(e, t) {
        var o = document.createElement("div");
        o.style.cursor = "pointer", o.style.textAlign = "center", o.title = "Click \u0111\u1ec3 b\u1eaft \u0111\u1ea7u t\xecm tr\xean b\u1ea3n \u0111\u1ed3", e.appendChild(o);
        var n = document.createElement("div");
        n.style.margin = "10px 10px 0 0", n.style.backgroundColor = "#0e5193", n.style.borderRadius = "5px", n.style.color = "#fff", n.style.fontFamily = '"Roboto",Helvetica,Arial,sans-serif', n.style.fontSize = "17px", n.style.padding = "7px 15px", searchMap ? n.innerHTML = '<i class="fa fa-check-square-o"></i> T\xecm theo b\u1ea3n \u0111\u1ed3' : n.innerHTML = '<i class="fa fa-square-o"></i> T\xecm theo b\u1ea3n \u0111\u1ed3', o.appendChild(n), o.addEventListener("mouseover", function() {}), o.addEventListener("click", function() {
            searchMap = !searchMap, searchMap ? n.innerHTML = '<i class="fa fa-check-square-o"></i> T\xecm theo b\u1ea3n \u0111\u1ed3' : n.innerHTML = '<i class="fa fa-square-o"></i> T\xecm theo b\u1ea3n \u0111\u1ed3'
        });
        var i = document.createElement("div");
        i.style.backgroundColor = "#fff", i.style.borderRadius = "5px", i.style.margin = "0 10px 0", i.style.display = "inline-block", i.style.color = "#000", i.style.fontFamily = "Helvetica,Arial,sans-serif", i.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)", i.style.fontSize = "16px", i.style.padding = "10px 10px", i.style.cursor = "pointer", i.innerHTML = '<i class="fa fa-dot-circle-o"></i>', i.title = "L\u1ea5y v\u1ecb tr\xed \u0111\u1ecba l\xfd hi\u1ec7n t\u1ea1i", i.addEventListener("click", function() {
            navigator.geolocation ? navigator.geolocation.getCurrentPosition(function(e) {
                var o = {
                        lat: e.coords.latitude,
                        lng: e.coords.longitude
                    },
                    n = new google.maps.MarkerImage("/images/marker-red.png", null, null, null, new google.maps.Size(48, 48)),
                    i = new google.maps.Marker({
                        position: o,
                        map: mymap.map,
                        icon: n
                    });
                i.setZIndex(google.maps.Marker.MAX_ZINDEX + 1), mymap.map.panTo(o), t.setCenter(o), mymap.map.setZoom(16), searchMap = !0, currentData.setMap(null), mymap.map.controls[google.maps.ControlPosition.TOP_RIGHT].pop(centerControlDiv);
                var s = mymap.getBounds(),
                    a = s.getNorthEast(),
                    r = s.getSouthWest(),
                    l = mymap.getZoom();
                search_lat = mymap.getCenter().lat(), search_lng = mymap.getCenter().lng(), property_within(a.lat(), a.lng(), r.lat(), r.lng(), l, search_type, search_type_filter, area_type_filter, price_type_filter, obs, 1)
            }, function() {
                console.log("Browser doesn't support Geolocation")
            }) : console.log("Browser doesn't support Geolocation")
        }), mymap.map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(i)
    },
    property_list_flatten = function(e) {
        property_list = [], $.each(e, function(e, t) {
            property_list = property_list.concat(t.props)
        })
    },
    load_default_map_marker = function(e, t) {
        $.each(t.slice().reverse(), function(t, o) {
            var n = new google.maps.LatLng(o.props[0].lat, o.props[0].lng),
                i = new MarkerWithLabel({
                    id: o.props[0].id,
                    num: 0,
                    price: o.props[0].price_desc,
                    position: n,
                    map: mymap.map,
                    icon: o.props[0].product_type_icon ? iconGolds[0] : icons[0],
                    iconType: !!o.props[0].product_type_icon,
                    area: o.props[0].area_desc,
                    labelContent: priceDecorate(o.props[0].price_desc),
                    labelAnchor: new google.maps.Point(22, 0),
                    labelClass: "marker-labels",
                    labelVisible: search_zoom >= 16,
                    props: createPropAttrs(o.props),
                    propertyData: o.props[0]
                });
            google.maps.event.addListener(i, "mouseover", function() {
                null != activeInfoWindow && activeInfoWindow.open(null, null), i.setIcon(iconHovers[0]), that && that.setZIndex(), that = this, this.setZIndex(google.maps.Marker.MAX_ZINDEX + 1);
                var e = setPropInfoContent(i.price, i.area, i.propertyData.prop_type);
                infobox.setContent(e), infobox.open(mymap.map, this), activeInfoWindow = infobox
            }), google.maps.event.addListener(i, "mouseout", function() {
                i.setIcon(i.iconType ? iconGolds[0] : icons[0])
            }), google.maps.event.addListener(i, "click", function() {
                handleQuickViewProperty(i.id)
            }), e.push(i)
        })
    },
    loadMapSearchMarkerDefault = function(e) {
        $.each(markers, function(e, t) {
            t.setMap(null)
        }), load_default_map_marker(markers, e), property_list_flatten(e)
    };
$(document).ready(function() {
    setTimeout(function() {
        infobox_init();
        var e = document.getElementsByTagName("head")[0],
            t = e.insertBefore;
        e.insertBefore = function(o, n) {
            o.href && 0 === o.href.indexOf("http://fonts.googleapis.com/css?family=Roboto:300,400,500,700") || t.call(e, o, n)
        }, options = _.merge(options, {
            div: "#map",
            lat: search_lat,
            lng: search_lng,
            zoom: search_zoom,
            dragend: function() {
                if (searchMap) {
                    var e = mymap.getBounds(),
                        t = e.getNorthEast(),
                        o = e.getSouthWest(),
                        n = mymap.getZoom();
                    search_lat = mymap.getCenter().lat(), search_lng = mymap.getCenter().lng(), search_zoom = n, property_within(t.lat(), t.lng(), o.lat(), o.lng(), n, search_type, search_type_filter, area_type_filter, price_type_filter, "", 1)
                }
            },
            click: function() {
                null != activeInfoWindow && activeInfoWindow.open(null, null)
            }
        }), mymap = new GMaps(options);
        var o = new google.maps.StyledMapType(styles, {
            name: "ZITA"
        });
        mymap.map.mapTypes.set("ZITA", o);
        var n = document.getElementById("map-ribbon");
        mymap.map.controls[google.maps.ControlPosition.TOP_LEFT].push(n);
        new CenterControl(centerControlDiv, mymap.map);
        if (centerControlDiv.index = 1, mymap.map.controls[google.maps.ControlPosition.TOP_RIGHT].push(centerControlDiv), $.ajax({
                url: window.location.href,
                type: "GET",
                dataType: "script",
                data: {
                    map_js: 1
                }
            }).done(function() {
                loadMapSearchMarkerDefault(props_list)
            }), mymap.setZoom(search_zoom), display_feature && loadMapFeature(mymap, {
                geo_type: geo_type,
                province: province_name,
                district: district_name,
                ward: ward_name
            }, search_location), 0 != interest_point) {
            var i = new google.maps.MarkerImage("/images/marker-red.png", null, null, null, new google.maps.Size(32, 32)),
                s = new google.maps.LatLng(interest_point.lat, interest_point.lng),
                a = new google.maps.Marker({
                    position: s,
                    map: mymap.map,
                    icon: i
                });
            a.setZIndex(google.maps.Marker.MAX_ZINDEX + 1), setTimeout(function() {
                mymap.map.panTo(s)
            }, 300)
        }
        isDevice || $("#resultList .row a.card-new").hover(prop_card_hover_handler);
    }, 10)
});