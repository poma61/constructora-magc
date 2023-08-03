/*
 * This combined file was created by the DataTables downloader builder:
 *   https://datatables.net/download
 *
 * To rebuild or modify this file with the latest versions of the included
 * software please visit:
 *   https://datatables.net/download/#bm/dt-1.13.5/b-2.4.1/b-colvis-2.4.1/fh-3.4.0/r-2.5.0/sc-2.2.0
 *
 * Included libraries:
 *  DataTables 1.13.5, Buttons 2.4.1, Column visibility 2.4.1, FixedHeader 3.4.0, Responsive 2.5.0, Scroller 2.2.0
 */

/*! DataTables 1.13.5
 * ©2008-2023 SpryMedia Ltd - datatables.net/license
 */
!(function (n) {
    "use strict";
    var a;
    "function" == typeof define && define.amd
        ? define(["jquery"], function (t) {
              return n(t, window, document);
          })
        : "object" == typeof exports
        ? ((a = require("jquery")),
          "undefined" != typeof window
              ? (module.exports = function (t, e) {
                    return (
                        (t = t || window), (e = e || a(t)), n(e, t, t.document)
                    );
                })
              : n(a, window, window.document))
        : (window.DataTable = n(jQuery, window, document));
})(function (P, j, y, H) {
    "use strict";
    function d(t) {
        var e = parseInt(t, 10);
        return !isNaN(e) && isFinite(t) ? e : null;
    }
    function l(t, e, n) {
        var a = typeof t,
            r = "string" == a;
        return (
            "number" == a ||
            "bigint" == a ||
            !!h(t) ||
            (e && r && (t = $(t, e)),
            n && r && (t = t.replace(q, "")),
            !isNaN(parseFloat(t)) && isFinite(t))
        );
    }
    function a(t, e, n) {
        var a;
        return (
            !!h(t) ||
            ((h((a = t)) || "string" == typeof a) &&
                !!l(t.replace(V, "").replace(/<script/i, ""), e, n)) ||
            null
        );
    }
    function m(t, e, n, a) {
        var r = [],
            o = 0,
            i = e.length;
        if (a !== H) for (; o < i; o++) t[e[o]][n] && r.push(t[e[o]][n][a]);
        else for (; o < i; o++) r.push(t[e[o]][n]);
        return r;
    }
    function f(t, e) {
        var n,
            a = [];
        e === H ? ((e = 0), (n = t)) : ((n = e), (e = t));
        for (var r = e; r < n; r++) a.push(r);
        return a;
    }
    function _(t) {
        for (var e = [], n = 0, a = t.length; n < a; n++) t[n] && e.push(t[n]);
        return e;
    }
    function s(t, e) {
        return -1 !== this.indexOf(t, (e = e === H ? 0 : e));
    }
    var p,
        e,
        t,
        w = function (t, v) {
            if (w.factory(t, v)) return w;
            if (this instanceof w) return P(t).DataTable(v);
            (v = t),
                (this.$ = function (t, e) {
                    return this.api(!0).$(t, e);
                }),
                (this._ = function (t, e) {
                    return this.api(!0).rows(t, e).data();
                }),
                (this.api = function (t) {
                    return new B(t ? ge(this[p.iApiIndex]) : this);
                }),
                (this.fnAddData = function (t, e) {
                    var n = this.api(!0),
                        t = (
                            Array.isArray(t) &&
                            (Array.isArray(t[0]) || P.isPlainObject(t[0]))
                                ? n.rows
                                : n.row
                        ).add(t);
                    return (e !== H && !e) || n.draw(), t.flatten().toArray();
                }),
                (this.fnAdjustColumnSizing = function (t) {
                    var e = this.api(!0).columns.adjust(),
                        n = e.settings()[0],
                        a = n.oScroll;
                    t === H || t
                        ? e.draw(!1)
                        : ("" === a.sX && "" === a.sY) || Qt(n);
                }),
                (this.fnClearTable = function (t) {
                    var e = this.api(!0).clear();
                    (t !== H && !t) || e.draw();
                }),
                (this.fnClose = function (t) {
                    this.api(!0).row(t).child.hide();
                }),
                (this.fnDeleteRow = function (t, e, n) {
                    var a = this.api(!0),
                        t = a.rows(t),
                        r = t.settings()[0],
                        o = r.aoData[t[0][0]];
                    return (
                        t.remove(),
                        e && e.call(this, r, o),
                        (n !== H && !n) || a.draw(),
                        o
                    );
                }),
                (this.fnDestroy = function (t) {
                    this.api(!0).destroy(t);
                }),
                (this.fnDraw = function (t) {
                    this.api(!0).draw(t);
                }),
                (this.fnFilter = function (t, e, n, a, r, o) {
                    var i = this.api(!0);
                    (null === e || e === H ? i : i.column(e)).search(
                        t,
                        n,
                        a,
                        o
                    ),
                        i.draw();
                }),
                (this.fnGetData = function (t, e) {
                    var n,
                        a = this.api(!0);
                    return t !== H
                        ? ((n = t.nodeName ? t.nodeName.toLowerCase() : ""),
                          e !== H || "td" == n || "th" == n
                              ? a.cell(t, e).data()
                              : a.row(t).data() || null)
                        : a.data().toArray();
                }),
                (this.fnGetNodes = function (t) {
                    var e = this.api(!0);
                    return t !== H
                        ? e.row(t).node()
                        : e.rows().nodes().flatten().toArray();
                }),
                (this.fnGetPosition = function (t) {
                    var e = this.api(!0),
                        n = t.nodeName.toUpperCase();
                    return "TR" == n
                        ? e.row(t).index()
                        : "TD" == n || "TH" == n
                        ? [
                              (n = e.cell(t).index()).row,
                              n.columnVisible,
                              n.column,
                          ]
                        : null;
                }),
                (this.fnIsOpen = function (t) {
                    return this.api(!0).row(t).child.isShown();
                }),
                (this.fnOpen = function (t, e, n) {
                    return this.api(!0).row(t).child(e, n).show().child()[0];
                }),
                (this.fnPageChange = function (t, e) {
                    t = this.api(!0).page(t);
                    (e !== H && !e) || t.draw(!1);
                }),
                (this.fnSetColumnVis = function (t, e, n) {
                    t = this.api(!0).column(t).visible(e);
                    (n !== H && !n) || t.columns.adjust().draw();
                }),
                (this.fnSettings = function () {
                    return ge(this[p.iApiIndex]);
                }),
                (this.fnSort = function (t) {
                    this.api(!0).order(t).draw();
                }),
                (this.fnSortListener = function (t, e, n) {
                    this.api(!0).order.listener(t, e, n);
                }),
                (this.fnUpdate = function (t, e, n, a, r) {
                    var o = this.api(!0);
                    return (
                        (n === H || null === n ? o.row(e) : o.cell(e, n)).data(
                            t
                        ),
                        (r !== H && !r) || o.columns.adjust(),
                        (a !== H && !a) || o.draw(),
                        0
                    );
                }),
                (this.fnVersionCheck = p.fnVersionCheck);
            var e,
                y = this,
                D = v === H,
                _ = this.length;
            for (e in (D && (v = {}),
            (this.oApi = this.internal = p.internal),
            w.ext.internal))
                e && (this[e] = $e(e));
            return (
                this.each(function () {
                    var r = 1 < _ ? be({}, v, !0) : v,
                        o = 0,
                        t = this.getAttribute("id"),
                        i = !1,
                        e = w.defaults,
                        l = P(this);
                    if ("table" != this.nodeName.toLowerCase())
                        W(
                            null,
                            0,
                            "Non-table node initialisation (" +
                                this.nodeName +
                                ")",
                            2
                        );
                    else {
                        K(e),
                            Q(e.column),
                            C(e, e, !0),
                            C(e.column, e.column, !0),
                            C(e, P.extend(r, l.data()), !0);
                        for (
                            var n = w.settings, o = 0, s = n.length;
                            o < s;
                            o++
                        ) {
                            var a = n[o];
                            if (
                                a.nTable == this ||
                                (a.nTHead && a.nTHead.parentNode == this) ||
                                (a.nTFoot && a.nTFoot.parentNode == this)
                            ) {
                                var u = (r.bRetrieve !== H ? r : e).bRetrieve,
                                    c = (r.bDestroy !== H ? r : e).bDestroy;
                                if (D || u) return a.oInstance;
                                if (c) {
                                    a.oInstance.fnDestroy();
                                    break;
                                }
                                return void W(
                                    a,
                                    0,
                                    "Cannot reinitialise DataTable",
                                    3
                                );
                            }
                            if (a.sTableId == this.id) {
                                n.splice(o, 1);
                                break;
                            }
                        }
                        (null !== t && "" !== t) ||
                            ((t = "DataTables_Table_" + w.ext._unique++),
                            (this.id = t));
                        var f,
                            d,
                            h = P.extend(!0, {}, w.models.oSettings, {
                                sDestroyWidth: l[0].style.width,
                                sInstance: t,
                                sTableId: t,
                            }),
                            p =
                                ((h.nTable = this),
                                (h.oApi = y.internal),
                                (h.oInit = r),
                                n.push(h),
                                (h.oInstance =
                                    1 === y.length ? y : l.dataTable()),
                                K(r),
                                Z(r.oLanguage),
                                r.aLengthMenu &&
                                    !r.iDisplayLength &&
                                    (r.iDisplayLength = (
                                        Array.isArray(r.aLengthMenu[0])
                                            ? r.aLengthMenu[0]
                                            : r.aLengthMenu
                                    )[0]),
                                (r = be(P.extend(!0, {}, e), r)),
                                F(h.oFeatures, r, [
                                    "bPaginate",
                                    "bLengthChange",
                                    "bFilter",
                                    "bSort",
                                    "bSortMulti",
                                    "bInfo",
                                    "bProcessing",
                                    "bAutoWidth",
                                    "bSortClasses",
                                    "bServerSide",
                                    "bDeferRender",
                                ]),
                                F(h, r, [
                                    "asStripeClasses",
                                    "ajax",
                                    "fnServerData",
                                    "fnFormatNumber",
                                    "sServerMethod",
                                    "aaSorting",
                                    "aaSortingFixed",
                                    "aLengthMenu",
                                    "sPaginationType",
                                    "sAjaxSource",
                                    "sAjaxDataProp",
                                    "iStateDuration",
                                    "sDom",
                                    "bSortCellsTop",
                                    "iTabIndex",
                                    "fnStateLoadCallback",
                                    "fnStateSaveCallback",
                                    "renderer",
                                    "searchDelay",
                                    "rowId",
                                    ["iCookieDuration", "iStateDuration"],
                                    ["oSearch", "oPreviousSearch"],
                                    ["aoSearchCols", "aoPreSearchCols"],
                                    ["iDisplayLength", "_iDisplayLength"],
                                ]),
                                F(h.oScroll, r, [
                                    ["sScrollX", "sX"],
                                    ["sScrollXInner", "sXInner"],
                                    ["sScrollY", "sY"],
                                    ["bScrollCollapse", "bCollapse"],
                                ]),
                                F(h.oLanguage, r, "fnInfoCallback"),
                                L(
                                    h,
                                    "aoDrawCallback",
                                    r.fnDrawCallback,
                                    "user"
                                ),
                                L(
                                    h,
                                    "aoServerParams",
                                    r.fnServerParams,
                                    "user"
                                ),
                                L(
                                    h,
                                    "aoStateSaveParams",
                                    r.fnStateSaveParams,
                                    "user"
                                ),
                                L(
                                    h,
                                    "aoStateLoadParams",
                                    r.fnStateLoadParams,
                                    "user"
                                ),
                                L(h, "aoStateLoaded", r.fnStateLoaded, "user"),
                                L(h, "aoRowCallback", r.fnRowCallback, "user"),
                                L(
                                    h,
                                    "aoRowCreatedCallback",
                                    r.fnCreatedRow,
                                    "user"
                                ),
                                L(
                                    h,
                                    "aoHeaderCallback",
                                    r.fnHeaderCallback,
                                    "user"
                                ),
                                L(
                                    h,
                                    "aoFooterCallback",
                                    r.fnFooterCallback,
                                    "user"
                                ),
                                L(
                                    h,
                                    "aoInitComplete",
                                    r.fnInitComplete,
                                    "user"
                                ),
                                L(
                                    h,
                                    "aoPreDrawCallback",
                                    r.fnPreDrawCallback,
                                    "user"
                                ),
                                (h.rowIdFn = A(r.rowId)),
                                tt(h),
                                h.oClasses),
                            g =
                                (P.extend(p, w.ext.classes, r.oClasses),
                                l.addClass(p.sTable),
                                h.iInitDisplayStart === H &&
                                    ((h.iInitDisplayStart = r.iDisplayStart),
                                    (h._iDisplayStart = r.iDisplayStart)),
                                null !== r.iDeferLoading &&
                                    ((h.bDeferLoading = !0),
                                    (t = Array.isArray(r.iDeferLoading)),
                                    (h._iRecordsDisplay = t
                                        ? r.iDeferLoading[0]
                                        : r.iDeferLoading),
                                    (h._iRecordsTotal = t
                                        ? r.iDeferLoading[1]
                                        : r.iDeferLoading)),
                                h.oLanguage),
                            t =
                                (P.extend(!0, g, r.oLanguage),
                                g.sUrl
                                    ? (P.ajax({
                                          dataType: "json",
                                          url: g.sUrl,
                                          success: function (t) {
                                              C(e.oLanguage, t),
                                                  Z(t),
                                                  P.extend(
                                                      !0,
                                                      g,
                                                      t,
                                                      h.oInit.oLanguage
                                                  ),
                                                  R(h, null, "i18n", [h]),
                                                  Jt(h);
                                          },
                                          error: function () {
                                              Jt(h);
                                          },
                                      }),
                                      (i = !0))
                                    : R(h, null, "i18n", [h]),
                                null === r.asStripeClasses &&
                                    (h.asStripeClasses = [
                                        p.sStripeOdd,
                                        p.sStripeEven,
                                    ]),
                                h.asStripeClasses),
                            b = l.children("tbody").find("tr").eq(0),
                            m =
                                (-1 !==
                                    P.inArray(
                                        !0,
                                        P.map(t, function (t, e) {
                                            return b.hasClass(t);
                                        })
                                    ) &&
                                    (P("tbody tr", this).removeClass(
                                        t.join(" ")
                                    ),
                                    (h.asDestroyStripes = t.slice())),
                                []),
                            t = this.getElementsByTagName("thead");
                        if (
                            (0 !== t.length &&
                                (wt(h.aoHeader, t[0]), (m = Ct(h))),
                            null === r.aoColumns)
                        )
                            for (f = [], o = 0, s = m.length; o < s; o++)
                                f.push(null);
                        else f = r.aoColumns;
                        for (o = 0, s = f.length; o < s; o++)
                            nt(h, m ? m[o] : null);
                        st(h, r.aoColumnDefs, f, function (t, e) {
                            at(h, t, e);
                        }),
                            b.length &&
                                ((d = function (t, e) {
                                    return null !== t.getAttribute("data-" + e)
                                        ? e
                                        : null;
                                }),
                                P(b[0])
                                    .children("th, td")
                                    .each(function (t, e) {
                                        var n,
                                            a = h.aoColumns[t];
                                        a ||
                                            W(
                                                h,
                                                0,
                                                "Incorrect column count",
                                                18
                                            ),
                                            a.mData === t &&
                                                ((n =
                                                    d(e, "sort") ||
                                                    d(e, "order")),
                                                (e =
                                                    d(e, "filter") ||
                                                    d(e, "search")),
                                                (null === n && null === e) ||
                                                    ((a.mData = {
                                                        _: t + ".display",
                                                        sort:
                                                            null !== n
                                                                ? t +
                                                                  ".@data-" +
                                                                  n
                                                                : H,
                                                        type:
                                                            null !== n
                                                                ? t +
                                                                  ".@data-" +
                                                                  n
                                                                : H,
                                                        filter:
                                                            null !== e
                                                                ? t +
                                                                  ".@data-" +
                                                                  e
                                                                : H,
                                                    }),
                                                    (a._isArrayHost = !0),
                                                    at(h, t)));
                                    }));
                        var S = h.oFeatures,
                            t = function () {
                                if (r.aaSorting === H) {
                                    var t = h.aaSorting;
                                    for (o = 0, s = t.length; o < s; o++)
                                        t[o][1] = h.aoColumns[o].asSorting[0];
                                }
                                ce(h),
                                    S.bSort &&
                                        L(h, "aoDrawCallback", function () {
                                            var t, n;
                                            h.bSorted &&
                                                ((t = I(h)),
                                                (n = {}),
                                                P.each(t, function (t, e) {
                                                    n[e.src] = e.dir;
                                                }),
                                                R(h, null, "order", [h, t, n]),
                                                le(h));
                                        }),
                                    L(
                                        h,
                                        "aoDrawCallback",
                                        function () {
                                            (h.bSorted ||
                                                "ssp" === E(h) ||
                                                S.bDeferRender) &&
                                                ce(h);
                                        },
                                        "sc"
                                    );
                                var e = l.children("caption").each(function () {
                                        this._captionSide =
                                            P(this).css("caption-side");
                                    }),
                                    n = l.children("thead"),
                                    a =
                                        (0 === n.length &&
                                            (n = P("<thead/>").appendTo(l)),
                                        (h.nTHead = n[0]),
                                        l.children("tbody")),
                                    n =
                                        (0 === a.length &&
                                            (a = P("<tbody/>").insertAfter(n)),
                                        (h.nTBody = a[0]),
                                        l.children("tfoot"));
                                if (
                                    (0 ===
                                        (n =
                                            0 === n.length &&
                                            0 < e.length &&
                                            ("" !== h.oScroll.sX ||
                                                "" !== h.oScroll.sY)
                                                ? P("<tfoot/>").appendTo(l)
                                                : n).length ||
                                    0 === n.children().length
                                        ? l.addClass(p.sNoFooter)
                                        : 0 < n.length &&
                                          ((h.nTFoot = n[0]),
                                          wt(h.aoFooter, h.nTFoot)),
                                    r.aaData)
                                )
                                    for (o = 0; o < r.aaData.length; o++)
                                        x(h, r.aaData[o]);
                                else
                                    (!h.bDeferLoading && "dom" != E(h)) ||
                                        ut(h, P(h.nTBody).children("tr"));
                                (h.aiDisplay = h.aiDisplayMaster.slice()),
                                    !(h.bInitialised = !0) === i && Jt(h);
                            };
                        L(h, "aoDrawCallback", de, "state_save"),
                            r.bStateSave
                                ? ((S.bStateSave = !0), he(h, 0, t))
                                : t();
                    }
                }),
                (y = null),
                this
            );
        },
        c = {},
        U = /[\r\n\u2028]/g,
        V = /<.*?>/g,
        X =
            /^\d{2,4}[\.\/\-]\d{1,2}[\.\/\-]\d{1,2}([T ]{1}\d{1,2}[:\.]\d{2}([\.:]\d{2})?)?$/,
        J = new RegExp(
            "(\\" +
                [
                    "/",
                    ".",
                    "*",
                    "+",
                    "?",
                    "|",
                    "(",
                    ")",
                    "[",
                    "]",
                    "{",
                    "}",
                    "\\",
                    "$",
                    "^",
                    "-",
                ].join("|\\") +
                ")",
            "g"
        ),
        q = /['\u00A0,$£€¥%\u2009\u202F\u20BD\u20a9\u20BArfkɃΞ]/gi,
        h = function (t) {
            return !t || !0 === t || "-" === t;
        },
        $ = function (t, e) {
            return (
                c[e] || (c[e] = new RegExp(Ot(e), "g")),
                "string" == typeof t && "." !== e
                    ? t.replace(/\./g, "").replace(c[e], ".")
                    : t
            );
        },
        N = function (t, e, n) {
            var a = [],
                r = 0,
                o = t.length;
            if (n !== H)
                for (; r < o; r++) t[r] && t[r][e] && a.push(t[r][e][n]);
            else for (; r < o; r++) t[r] && a.push(t[r][e]);
            return a;
        },
        G = function (t) {
            if (!(t.length < 2))
                for (
                    var e = t.slice().sort(), n = e[0], a = 1, r = e.length;
                    a < r;
                    a++
                ) {
                    if (e[a] === n) return !1;
                    n = e[a];
                }
            return !0;
        },
        z = function (t) {
            if (G(t)) return t.slice();
            var e,
                n,
                a,
                r = [],
                o = t.length,
                i = 0;
            t: for (n = 0; n < o; n++) {
                for (e = t[n], a = 0; a < i; a++) if (r[a] === e) continue t;
                r.push(e), i++;
            }
            return r;
        },
        Y = function (t, e) {
            if (Array.isArray(e)) for (var n = 0; n < e.length; n++) Y(t, e[n]);
            else t.push(e);
            return t;
        };
    function i(n) {
        var a,
            r,
            o = {};
        P.each(n, function (t, e) {
            (a = t.match(/^([^A-Z]+?)([A-Z])/)) &&
                -1 !== "a aa ai ao as b fn i m o s ".indexOf(a[1] + " ") &&
                ((r = t.replace(a[0], a[2].toLowerCase())),
                (o[r] = t),
                "o" === a[1]) &&
                i(n[t]);
        }),
            (n._hungarianMap = o);
    }
    function C(n, a, r) {
        var o;
        n._hungarianMap || i(n),
            P.each(a, function (t, e) {
                (o = n._hungarianMap[t]) === H ||
                    (!r && a[o] !== H) ||
                    ("o" === o.charAt(0)
                        ? (a[o] || (a[o] = {}),
                          P.extend(!0, a[o], a[t]),
                          C(n[o], a[o], r))
                        : (a[o] = a[t]));
            });
    }
    function Z(t) {
        var e,
            n = w.defaults.oLanguage,
            a = n.sDecimal;
        a && Me(a),
            t &&
                ((e = t.sZeroRecords),
                !t.sEmptyTable &&
                    e &&
                    "No data available in table" === n.sEmptyTable &&
                    F(t, t, "sZeroRecords", "sEmptyTable"),
                !t.sLoadingRecords &&
                    e &&
                    "Loading..." === n.sLoadingRecords &&
                    F(t, t, "sZeroRecords", "sLoadingRecords"),
                t.sInfoThousands && (t.sThousands = t.sInfoThousands),
                (e = t.sDecimal)) &&
                a !== e &&
                Me(e);
    }
    Array.isArray ||
        (Array.isArray = function (t) {
            return "[object Array]" === Object.prototype.toString.call(t);
        }),
        Array.prototype.includes || (Array.prototype.includes = s),
        String.prototype.trim ||
            (String.prototype.trim = function () {
                return this.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, "");
            }),
        String.prototype.includes || (String.prototype.includes = s),
        (w.util = {
            throttle: function (a, t) {
                var r,
                    o,
                    i = t !== H ? t : 200;
                return function () {
                    var t = this,
                        e = +new Date(),
                        n = arguments;
                    r && e < r + i
                        ? (clearTimeout(o),
                          (o = setTimeout(function () {
                              (r = H), a.apply(t, n);
                          }, i)))
                        : ((r = e), a.apply(t, n));
                };
            },
            escapeRegex: function (t) {
                return t.replace(J, "\\$1");
            },
            set: function (a) {
                var d;
                return P.isPlainObject(a)
                    ? w.util.set(a._)
                    : null === a
                    ? function () {}
                    : "function" == typeof a
                    ? function (t, e, n) {
                          a(t, "set", e, n);
                      }
                    : "string" != typeof a ||
                      (-1 === a.indexOf(".") &&
                          -1 === a.indexOf("[") &&
                          -1 === a.indexOf("("))
                    ? function (t, e) {
                          t[a] = e;
                      }
                    : ((d = function (t, e, n) {
                          for (
                              var a,
                                  r,
                                  o,
                                  i,
                                  l = dt(n),
                                  n = l[l.length - 1],
                                  s = 0,
                                  u = l.length - 1;
                              s < u;
                              s++
                          ) {
                              if (
                                  "__proto__" === l[s] ||
                                  "constructor" === l[s]
                              )
                                  throw new Error(
                                      "Cannot set prototype values"
                                  );
                              if (
                                  ((a = l[s].match(ft)), (r = l[s].match(g)), a)
                              ) {
                                  if (
                                      ((l[s] = l[s].replace(ft, "")),
                                      (t[l[s]] = []),
                                      (a = l.slice()).splice(0, s + 1),
                                      (i = a.join(".")),
                                      Array.isArray(e))
                                  )
                                      for (var c = 0, f = e.length; c < f; c++)
                                          d((o = {}), e[c], i), t[l[s]].push(o);
                                  else t[l[s]] = e;
                                  return;
                              }
                              r &&
                                  ((l[s] = l[s].replace(g, "")),
                                  (t = t[l[s]](e))),
                                  (null !== t[l[s]] && t[l[s]] !== H) ||
                                      (t[l[s]] = {}),
                                  (t = t[l[s]]);
                          }
                          n.match(g)
                              ? t[n.replace(g, "")](e)
                              : (t[n.replace(ft, "")] = e);
                      }),
                      function (t, e) {
                          return d(t, e, a);
                      });
            },
            get: function (r) {
                var o, d;
                return P.isPlainObject(r)
                    ? ((o = {}),
                      P.each(r, function (t, e) {
                          e && (o[t] = w.util.get(e));
                      }),
                      function (t, e, n, a) {
                          var r = o[e] || o._;
                          return r !== H ? r(t, e, n, a) : t;
                      })
                    : null === r
                    ? function (t) {
                          return t;
                      }
                    : "function" == typeof r
                    ? function (t, e, n, a) {
                          return r(t, e, n, a);
                      }
                    : "string" != typeof r ||
                      (-1 === r.indexOf(".") &&
                          -1 === r.indexOf("[") &&
                          -1 === r.indexOf("("))
                    ? function (t, e) {
                          return t[r];
                      }
                    : ((d = function (t, e, n) {
                          var a, r, o;
                          if ("" !== n)
                              for (
                                  var i = dt(n), l = 0, s = i.length;
                                  l < s;
                                  l++
                              ) {
                                  if (
                                      ((f = i[l].match(ft)),
                                      (a = i[l].match(g)),
                                      f)
                                  ) {
                                      if (
                                          ((i[l] = i[l].replace(ft, "")),
                                          "" !== i[l] && (t = t[i[l]]),
                                          (r = []),
                                          i.splice(0, l + 1),
                                          (o = i.join(".")),
                                          Array.isArray(t))
                                      )
                                          for (
                                              var u = 0, c = t.length;
                                              u < c;
                                              u++
                                          )
                                              r.push(d(t[u], e, o));
                                      var f = f[0].substring(
                                          1,
                                          f[0].length - 1
                                      );
                                      t = "" === f ? r : r.join(f);
                                      break;
                                  }
                                  if (a)
                                      (i[l] = i[l].replace(g, "")),
                                          (t = t[i[l]]());
                                  else {
                                      if (null === t || null === t[i[l]])
                                          return null;
                                      if (t === H || t[i[l]] === H) return H;
                                      t = t[i[l]];
                                  }
                              }
                          return t;
                      }),
                      function (t, e) {
                          return d(t, e, r);
                      });
            },
        });
    var r = function (t, e, n) {
        t[e] !== H && (t[n] = t[e]);
    };
    function K(t) {
        r(t, "ordering", "bSort"),
            r(t, "orderMulti", "bSortMulti"),
            r(t, "orderClasses", "bSortClasses"),
            r(t, "orderCellsTop", "bSortCellsTop"),
            r(t, "order", "aaSorting"),
            r(t, "orderFixed", "aaSortingFixed"),
            r(t, "paging", "bPaginate"),
            r(t, "pagingType", "sPaginationType"),
            r(t, "pageLength", "iDisplayLength"),
            r(t, "searching", "bFilter"),
            "boolean" == typeof t.sScrollX &&
                (t.sScrollX = t.sScrollX ? "100%" : ""),
            "boolean" == typeof t.scrollX &&
                (t.scrollX = t.scrollX ? "100%" : "");
        var e = t.aoSearchCols;
        if (e)
            for (var n = 0, a = e.length; n < a; n++)
                e[n] && C(w.models.oSearch, e[n]);
    }
    function Q(t) {
        r(t, "orderable", "bSortable"),
            r(t, "orderData", "aDataSort"),
            r(t, "orderSequence", "asSorting"),
            r(t, "orderDataType", "sortDataType");
        var e = t.aDataSort;
        "number" != typeof e || Array.isArray(e) || (t.aDataSort = [e]);
    }
    function tt(t) {
        var e, n, a, r;
        w.__browser ||
            ((w.__browser = e = {}),
            (r = (a = (n = P("<div/>")
                .css({
                    position: "fixed",
                    top: 0,
                    left: -1 * P(j).scrollLeft(),
                    height: 1,
                    width: 1,
                    overflow: "hidden",
                })
                .append(
                    P("<div/>")
                        .css({
                            position: "absolute",
                            top: 1,
                            left: 1,
                            width: 100,
                            overflow: "scroll",
                        })
                        .append(P("<div/>").css({ width: "100%", height: 10 }))
                )
                .appendTo("body")).children()).children()),
            (e.barWidth = a[0].offsetWidth - a[0].clientWidth),
            (e.bScrollOversize =
                100 === r[0].offsetWidth && 100 !== a[0].clientWidth),
            (e.bScrollbarLeft = 1 !== Math.round(r.offset().left)),
            (e.bBounding = !!n[0].getBoundingClientRect().width),
            n.remove()),
            P.extend(t.oBrowser, w.__browser),
            (t.oScroll.iBarWidth = w.__browser.barWidth);
    }
    function et(t, e, n, a, r, o) {
        var i,
            l = a,
            s = !1;
        for (n !== H && ((i = n), (s = !0)); l !== r; )
            t.hasOwnProperty(l) &&
                ((i = s ? e(i, t[l], l, t) : t[l]), (s = !0), (l += o));
        return i;
    }
    function nt(t, e) {
        var n = w.defaults.column,
            a = t.aoColumns.length,
            n = P.extend({}, w.models.oColumn, n, {
                nTh: e || y.createElement("th"),
                sTitle: n.sTitle || (e ? e.innerHTML : ""),
                aDataSort: n.aDataSort || [a],
                mData: n.mData || a,
                idx: a,
            }),
            n = (t.aoColumns.push(n), t.aoPreSearchCols);
        (n[a] = P.extend({}, w.models.oSearch, n[a])), at(t, a, P(e).data());
    }
    function at(t, e, n) {
        function a(t) {
            return "string" == typeof t && -1 !== t.indexOf("@");
        }
        var e = t.aoColumns[e],
            r = t.oClasses,
            o = P(e.nTh),
            i =
                (!e.sWidthOrig &&
                    ((e.sWidthOrig = o.attr("width") || null),
                    (u = (o.attr("style") || "").match(
                        /width:\s*(\d+[pxem%]+)/
                    ))) &&
                    (e.sWidthOrig = u[1]),
                n !== H &&
                    null !== n &&
                    (Q(n),
                    C(w.defaults.column, n, !0),
                    n.mDataProp === H || n.mData || (n.mData = n.mDataProp),
                    n.sType && (e._sManualType = n.sType),
                    n.className && !n.sClass && (n.sClass = n.className),
                    n.sClass && o.addClass(n.sClass),
                    (u = e.sClass),
                    P.extend(e, n),
                    F(e, n, "sWidth", "sWidthOrig"),
                    u !== e.sClass && (e.sClass = u + " " + e.sClass),
                    n.iDataSort !== H && (e.aDataSort = [n.iDataSort]),
                    F(e, n, "aDataSort")),
                e.mData),
            l = A(i),
            s = e.mRender ? A(e.mRender) : null,
            u =
                ((e._bAttrSrc =
                    P.isPlainObject(i) &&
                    (a(i.sort) || a(i.type) || a(i.filter))),
                (e._setter = null),
                (e.fnGetData = function (t, e, n) {
                    var a = l(t, e, H, n);
                    return s && e ? s(a, e, t, n) : a;
                }),
                (e.fnSetData = function (t, e, n) {
                    return b(i)(t, e, n);
                }),
                "number" == typeof i ||
                    e._isArrayHost ||
                    (t._rowReadObject = !0),
                t.oFeatures.bSort ||
                    ((e.bSortable = !1), o.addClass(r.sSortableNone)),
                -1 !== P.inArray("asc", e.asSorting)),
            n = -1 !== P.inArray("desc", e.asSorting);
        e.bSortable && (u || n)
            ? u && !n
                ? ((e.sSortingClass = r.sSortableAsc),
                  (e.sSortingClassJUI = r.sSortJUIAscAllowed))
                : !u && n
                ? ((e.sSortingClass = r.sSortableDesc),
                  (e.sSortingClassJUI = r.sSortJUIDescAllowed))
                : ((e.sSortingClass = r.sSortable),
                  (e.sSortingClassJUI = r.sSortJUI))
            : ((e.sSortingClass = r.sSortableNone), (e.sSortingClassJUI = ""));
    }
    function O(t) {
        if (!1 !== t.oFeatures.bAutoWidth) {
            var e = t.aoColumns;
            ee(t);
            for (var n = 0, a = e.length; n < a; n++)
                e[n].nTh.style.width = e[n].sWidth;
        }
        var r = t.oScroll;
        ("" === r.sY && "" === r.sX) || Qt(t), R(t, null, "column-sizing", [t]);
    }
    function rt(t, e) {
        t = it(t, "bVisible");
        return "number" == typeof t[e] ? t[e] : null;
    }
    function ot(t, e) {
        (t = it(t, "bVisible")), (e = P.inArray(e, t));
        return -1 !== e ? e : null;
    }
    function T(t) {
        var n = 0;
        return (
            P.each(t.aoColumns, function (t, e) {
                e.bVisible && "none" !== P(e.nTh).css("display") && n++;
            }),
            n
        );
    }
    function it(t, n) {
        var a = [];
        return (
            P.map(t.aoColumns, function (t, e) {
                t[n] && a.push(e);
            }),
            a
        );
    }
    function lt(t) {
        for (
            var e,
                n,
                a,
                r,
                o,
                i,
                l,
                s = t.aoColumns,
                u = t.aoData,
                c = w.ext.type.detect,
                f = 0,
                d = s.length;
            f < d;
            f++
        )
            if (((l = []), !(o = s[f]).sType && o._sManualType))
                o.sType = o._sManualType;
            else if (!o.sType) {
                for (e = 0, n = c.length; e < n; e++) {
                    for (
                        a = 0, r = u.length;
                        a < r &&
                        (l[a] === H && (l[a] = S(t, a, f, "type")),
                        (i = c[e](l[a], t)) || e === c.length - 1) &&
                        ("html" !== i || h(l[a]));
                        a++
                    );
                    if (i) {
                        o.sType = i;
                        break;
                    }
                }
                o.sType || (o.sType = "string");
            }
    }
    function st(t, e, n, a) {
        var r,
            o,
            i,
            l,
            s = t.aoColumns;
        if (e)
            for (r = e.length - 1; 0 <= r; r--)
                for (
                    var u,
                        c =
                            (u = e[r]).target !== H
                                ? u.target
                                : u.targets !== H
                                ? u.targets
                                : u.aTargets,
                        f = 0,
                        d = (c = Array.isArray(c) ? c : [c]).length;
                    f < d;
                    f++
                )
                    if ("number" == typeof c[f] && 0 <= c[f]) {
                        for (; s.length <= c[f]; ) nt(t);
                        a(c[f], u);
                    } else if ("number" == typeof c[f] && c[f] < 0)
                        a(s.length + c[f], u);
                    else if ("string" == typeof c[f])
                        for (i = 0, l = s.length; i < l; i++)
                            ("_all" != c[f] && !P(s[i].nTh).hasClass(c[f])) ||
                                a(i, u);
        if (n) for (r = 0, o = n.length; r < o; r++) a(r, n[r]);
    }
    function x(t, e, n, a) {
        for (
            var r = t.aoData.length,
                o = P.extend(!0, {}, w.models.oRow, {
                    src: n ? "dom" : "data",
                    idx: r,
                }),
                i = ((o._aData = e), t.aoData.push(o), t.aoColumns),
                l = 0,
                s = i.length;
            l < s;
            l++
        )
            i[l].sType = null;
        t.aiDisplayMaster.push(r);
        e = t.rowIdFn(e);
        return (
            e !== H && (t.aIds[e] = o),
            (!n && t.oFeatures.bDeferRender) || St(t, r, n, a),
            r
        );
    }
    function ut(n, t) {
        var a;
        return (t = t instanceof P ? t : P(t)).map(function (t, e) {
            return (a = mt(n, e)), x(n, a.data, e, a.cells);
        });
    }
    function S(t, e, n, a) {
        "search" === a ? (a = "filter") : "order" === a && (a = "sort");
        var r = t.iDraw,
            o = t.aoColumns[n],
            i = t.aoData[e]._aData,
            l = o.sDefaultContent,
            s = o.fnGetData(i, a, { settings: t, row: e, col: n });
        if (s === H)
            return (
                t.iDrawError != r &&
                    null === l &&
                    (W(
                        t,
                        0,
                        "Requested unknown parameter " +
                            ("function" == typeof o.mData
                                ? "{function}"
                                : "'" + o.mData + "'") +
                            " for row " +
                            e +
                            ", column " +
                            n,
                        4
                    ),
                    (t.iDrawError = r)),
                l
            );
        if ((s !== i && null !== s) || null === l || a === H) {
            if ("function" == typeof s) return s.call(i);
        } else s = l;
        return null === s && "display" === a
            ? ""
            : "filter" === a && (e = w.ext.type.search)[o.sType]
            ? e[o.sType](s)
            : s;
    }
    function ct(t, e, n, a) {
        var r = t.aoColumns[n],
            o = t.aoData[e]._aData;
        r.fnSetData(o, a, { settings: t, row: e, col: n });
    }
    var ft = /\[.*?\]$/,
        g = /\(\)$/;
    function dt(t) {
        return P.map(t.match(/(\\.|[^\.])+/g) || [""], function (t) {
            return t.replace(/\\\./g, ".");
        });
    }
    var A = w.util.get,
        b = w.util.set;
    function ht(t) {
        return N(t.aoData, "_aData");
    }
    function pt(t) {
        (t.aoData.length = 0),
            (t.aiDisplayMaster.length = 0),
            (t.aiDisplay.length = 0),
            (t.aIds = {});
    }
    function gt(t, e, n) {
        for (var a = -1, r = 0, o = t.length; r < o; r++)
            t[r] == e ? (a = r) : t[r] > e && t[r]--;
        -1 != a && n === H && t.splice(a, 1);
    }
    function bt(n, a, t, e) {
        function r(t, e) {
            for (; t.childNodes.length; ) t.removeChild(t.firstChild);
            t.innerHTML = S(n, a, e, "display");
        }
        var o,
            i,
            l = n.aoData[a];
        if ("dom" !== t && ((t && "auto" !== t) || "dom" !== l.src)) {
            var s = l.anCells;
            if (s)
                if (e !== H) r(s[e], e);
                else for (o = 0, i = s.length; o < i; o++) r(s[o], o);
        } else l._aData = mt(n, l, e, e === H ? H : l._aData).data;
        (l._aSortData = null), (l._aFilterData = null);
        var u = n.aoColumns;
        if (e !== H) u[e].sType = null;
        else {
            for (o = 0, i = u.length; o < i; o++) u[o].sType = null;
            vt(n, l);
        }
    }
    function mt(t, e, n, a) {
        function r(t, e) {
            var n;
            "string" == typeof t &&
                -1 !== (n = t.indexOf("@")) &&
                ((n = t.substring(n + 1)), b(t)(a, e.getAttribute(n)));
        }
        function o(t) {
            (n !== H && n !== f) ||
                ((l = d[f]),
                (s = t.innerHTML.trim()),
                l && l._bAttrSrc
                    ? (b(l.mData._)(a, s),
                      r(l.mData.sort, t),
                      r(l.mData.type, t),
                      r(l.mData.filter, t))
                    : h
                    ? (l._setter || (l._setter = b(l.mData)), l._setter(a, s))
                    : (a[f] = s)),
                f++;
        }
        var i,
            l,
            s,
            u = [],
            c = e.firstChild,
            f = 0,
            d = t.aoColumns,
            h = t._rowReadObject;
        a = a !== H ? a : h ? {} : [];
        if (c)
            for (; c; )
                ("TD" != (i = c.nodeName.toUpperCase()) && "TH" != i) ||
                    (o(c), u.push(c)),
                    (c = c.nextSibling);
        else for (var p = 0, g = (u = e.anCells).length; p < g; p++) o(u[p]);
        var e = e.firstChild ? e : e.nTr;
        return (
            e && (e = e.getAttribute("id")) && b(t.rowId)(a, e),
            { data: a, cells: u }
        );
    }
    function St(t, e, n, a) {
        var r,
            o,
            i,
            l,
            s,
            u,
            c = t.aoData[e],
            f = c._aData,
            d = [];
        if (null === c.nTr) {
            for (
                r = n || y.createElement("tr"),
                    c.nTr = r,
                    c.anCells = d,
                    r._DT_RowIndex = e,
                    vt(t, c),
                    l = 0,
                    s = t.aoColumns.length;
                l < s;
                l++
            )
                (i = t.aoColumns[l]),
                    (o = (u = !n) ? y.createElement(i.sCellType) : a[l]) ||
                        W(t, 0, "Incorrect column count", 18),
                    (o._DT_CellIndex = { row: e, column: l }),
                    d.push(o),
                    (!u &&
                        ((!i.mRender && i.mData === l) ||
                            (P.isPlainObject(i.mData) &&
                                i.mData._ === l + ".display"))) ||
                        (o.innerHTML = S(t, e, l, "display")),
                    i.sClass && (o.className += " " + i.sClass),
                    i.bVisible && !n
                        ? r.appendChild(o)
                        : !i.bVisible && n && o.parentNode.removeChild(o),
                    i.fnCreatedCell &&
                        i.fnCreatedCell.call(
                            t.oInstance,
                            o,
                            S(t, e, l),
                            f,
                            e,
                            l
                        );
            R(t, "aoRowCreatedCallback", null, [r, f, e, d]);
        }
    }
    function vt(t, e) {
        var n = e.nTr,
            a = e._aData;
        n &&
            ((t = t.rowIdFn(a)) && (n.id = t),
            a.DT_RowClass &&
                ((t = a.DT_RowClass.split(" ")),
                (e.__rowc = e.__rowc ? z(e.__rowc.concat(t)) : t),
                P(n).removeClass(e.__rowc.join(" ")).addClass(a.DT_RowClass)),
            a.DT_RowAttr && P(n).attr(a.DT_RowAttr),
            a.DT_RowData) &&
            P(n).data(a.DT_RowData);
    }
    function yt(t) {
        var e,
            n,
            a,
            r = t.nTHead,
            o = t.nTFoot,
            i = 0 === P("th, td", r).length,
            l = t.oClasses,
            s = t.aoColumns;
        for (i && (n = P("<tr/>").appendTo(r)), c = 0, f = s.length; c < f; c++)
            (a = s[c]),
                (e = P(a.nTh).addClass(a.sClass)),
                i && e.appendTo(n),
                t.oFeatures.bSort &&
                    (e.addClass(a.sSortingClass), !1 !== a.bSortable) &&
                    (e
                        .attr("tabindex", t.iTabIndex)
                        .attr("aria-controls", t.sTableId),
                    ue(t, a.nTh, c)),
                a.sTitle != e[0].innerHTML && e.html(a.sTitle),
                ve(t, "header")(t, e, a, l);
        if (
            (i && wt(t.aoHeader, r),
            P(r).children("tr").children("th, td").addClass(l.sHeaderTH),
            P(o).children("tr").children("th, td").addClass(l.sFooterTH),
            null !== o)
        )
            for (var u = t.aoFooter[0], c = 0, f = u.length; c < f; c++)
                (a = s[c])
                    ? ((a.nTf = u[c].cell),
                      a.sClass && P(a.nTf).addClass(a.sClass))
                    : W(t, 0, "Incorrect column count", 18);
    }
    function Dt(t, e, n) {
        var a,
            r,
            o,
            i,
            l,
            s,
            u,
            c,
            f,
            d = [],
            h = [],
            p = t.aoColumns.length;
        if (e) {
            for (n === H && (n = !1), a = 0, r = e.length; a < r; a++) {
                for (
                    d[a] = e[a].slice(), d[a].nTr = e[a].nTr, o = p - 1;
                    0 <= o;
                    o--
                )
                    t.aoColumns[o].bVisible || n || d[a].splice(o, 1);
                h.push([]);
            }
            for (a = 0, r = d.length; a < r; a++) {
                if ((u = d[a].nTr))
                    for (; (s = u.firstChild); ) u.removeChild(s);
                for (o = 0, i = d[a].length; o < i; o++)
                    if (((f = c = 1), h[a][o] === H)) {
                        for (
                            u.appendChild(d[a][o].cell), h[a][o] = 1;
                            d[a + c] !== H && d[a][o].cell == d[a + c][o].cell;

                        )
                            (h[a + c][o] = 1), c++;
                        for (
                            ;
                            d[a][o + f] !== H &&
                            d[a][o].cell == d[a][o + f].cell;

                        ) {
                            for (l = 0; l < c; l++) h[a + l][o + f] = 1;
                            f++;
                        }
                        P(d[a][o].cell).attr("rowspan", c).attr("colspan", f);
                    }
            }
        }
    }
    function v(t, e) {
        (n = "ssp" == E((s = t))),
            (l = s.iInitDisplayStart) !== H &&
                -1 !== l &&
                ((s._iDisplayStart = !n && l >= s.fnRecordsDisplay() ? 0 : l),
                (s.iInitDisplayStart = -1));
        var n = R(t, "aoPreDrawCallback", "preDraw", [t]);
        if (-1 !== P.inArray(!1, n)) D(t, !1);
        else {
            var a = [],
                r = 0,
                o = t.asStripeClasses,
                i = o.length,
                l = t.oLanguage,
                s = "ssp" == E(t),
                u = t.aiDisplay,
                n = t._iDisplayStart,
                c = t.fnDisplayEnd();
            if (((t.bDrawing = !0), t.bDeferLoading))
                (t.bDeferLoading = !1), t.iDraw++, D(t, !1);
            else if (s) {
                if (!t.bDestroying && !e) return void xt(t);
            } else t.iDraw++;
            if (0 !== u.length)
                for (
                    var f = s ? t.aoData.length : c, d = s ? 0 : n;
                    d < f;
                    d++
                ) {
                    var h,
                        p = u[d],
                        g = t.aoData[p],
                        b = (null === g.nTr && St(t, p), g.nTr);
                    0 !== i &&
                        ((h = o[r % i]), g._sRowStripe != h) &&
                        (P(b).removeClass(g._sRowStripe).addClass(h),
                        (g._sRowStripe = h)),
                        R(t, "aoRowCallback", null, [b, g._aData, r, d, p]),
                        a.push(b),
                        r++;
                }
            else {
                e = l.sZeroRecords;
                1 == t.iDraw && "ajax" == E(t)
                    ? (e = l.sLoadingRecords)
                    : l.sEmptyTable &&
                      0 === t.fnRecordsTotal() &&
                      (e = l.sEmptyTable),
                    (a[0] = P("<tr/>", { class: i ? o[0] : "" }).append(
                        P("<td />", {
                            valign: "top",
                            colSpan: T(t),
                            class: t.oClasses.sRowEmpty,
                        }).html(e)
                    )[0]);
            }
            R(t, "aoHeaderCallback", "header", [
                P(t.nTHead).children("tr")[0],
                ht(t),
                n,
                c,
                u,
            ]),
                R(t, "aoFooterCallback", "footer", [
                    P(t.nTFoot).children("tr")[0],
                    ht(t),
                    n,
                    c,
                    u,
                ]);
            s = P(t.nTBody);
            s.children().detach(),
                s.append(P(a)),
                R(t, "aoDrawCallback", "draw", [t]),
                (t.bSorted = !1),
                (t.bFiltered = !1),
                (t.bDrawing = !1);
        }
    }
    function u(t, e) {
        var n = t.oFeatures,
            a = n.bSort,
            n = n.bFilter;
        a && ie(t),
            n
                ? Rt(t, t.oPreviousSearch)
                : (t.aiDisplay = t.aiDisplayMaster.slice()),
            !0 !== e && (t._iDisplayStart = 0),
            (t._drawHold = e),
            v(t),
            (t._drawHold = !1);
    }
    function _t(t) {
        for (
            var e,
                n,
                a,
                r,
                o,
                i,
                l,
                s = t.oClasses,
                u = P(t.nTable),
                u = P("<div/>").insertBefore(u),
                c = t.oFeatures,
                f = P("<div/>", {
                    id: t.sTableId + "_wrapper",
                    class: s.sWrapper + (t.nTFoot ? "" : " " + s.sNoFooter),
                }),
                d =
                    ((t.nHolding = u[0]),
                    (t.nTableWrapper = f[0]),
                    (t.nTableReinsertBefore = t.nTable.nextSibling),
                    t.sDom.split("")),
                h = 0;
            h < d.length;
            h++
        ) {
            if (((e = null), "<" == (n = d[h]))) {
                if (((a = P("<div/>")[0]), "'" == (r = d[h + 1]) || '"' == r)) {
                    for (o = "", i = 2; d[h + i] != r; ) (o += d[h + i]), i++;
                    "H" == o
                        ? (o = s.sJUIHeader)
                        : "F" == o && (o = s.sJUIFooter),
                        -1 != o.indexOf(".")
                            ? ((l = o.split(".")),
                              (a.id = l[0].substr(1, l[0].length - 1)),
                              (a.className = l[1]))
                            : "#" == o.charAt(0)
                            ? (a.id = o.substr(1, o.length - 1))
                            : (a.className = o),
                        (h += i);
                }
                f.append(a), (f = P(a));
            } else if (">" == n) f = f.parent();
            else if ("l" == n && c.bPaginate && c.bLengthChange) e = Gt(t);
            else if ("f" == n && c.bFilter) e = Lt(t);
            else if ("r" == n && c.bProcessing) e = Zt(t);
            else if ("t" == n) e = Kt(t);
            else if ("i" == n && c.bInfo) e = Ut(t);
            else if ("p" == n && c.bPaginate) e = zt(t);
            else if (0 !== w.ext.feature.length)
                for (var p = w.ext.feature, g = 0, b = p.length; g < b; g++)
                    if (n == p[g].cFeature) {
                        e = p[g].fnInit(t);
                        break;
                    }
            e &&
                ((l = t.aanFeatures)[n] || (l[n] = []),
                l[n].push(e),
                f.append(e));
        }
        u.replaceWith(f), (t.nHolding = null);
    }
    function wt(t, e) {
        var n,
            a,
            r,
            o,
            i,
            l,
            s,
            u,
            c,
            f,
            d = P(e).children("tr");
        for (t.splice(0, t.length), r = 0, l = d.length; r < l; r++) t.push([]);
        for (r = 0, l = d.length; r < l; r++)
            for (a = (n = d[r]).firstChild; a; ) {
                if (
                    "TD" == a.nodeName.toUpperCase() ||
                    "TH" == a.nodeName.toUpperCase()
                )
                    for (
                        u =
                            (u = +a.getAttribute("colspan")) && 0 != u && 1 != u
                                ? u
                                : 1,
                            c =
                                (c = +a.getAttribute("rowspan")) &&
                                0 != c &&
                                1 != c
                                    ? c
                                    : 1,
                            s = (function (t, e, n) {
                                for (var a = t[e]; a[n]; ) n++;
                                return n;
                            })(t, r, 0),
                            f = 1 == u,
                            i = 0;
                        i < u;
                        i++
                    )
                        for (o = 0; o < c; o++)
                            (t[r + o][s + i] = { cell: a, unique: f }),
                                (t[r + o].nTr = n);
                a = a.nextSibling;
            }
    }
    function Ct(t, e, n) {
        var a = [];
        n || ((n = t.aoHeader), e && wt((n = []), e));
        for (var r = 0, o = n.length; r < o; r++)
            for (var i = 0, l = n[r].length; i < l; i++)
                !n[r][i].unique ||
                    (a[i] && t.bSortCellsTop) ||
                    (a[i] = n[r][i].cell);
        return a;
    }
    function Tt(r, t, n) {
        function e(t) {
            var e = r.jqXHR ? r.jqXHR.status : null;
            (null === t || ("number" == typeof e && 204 == e)) &&
                Ft(r, (t = {}), []),
                (e = t.error || t.sError) && W(r, 0, e),
                (r.json = t),
                R(r, null, "xhr", [r, t, r.jqXHR]),
                n(t);
        }
        R(r, "aoServerParams", "serverParams", [t]),
            t &&
                Array.isArray(t) &&
                ((a = {}),
                (o = /(.*?)\[\]$/),
                P.each(t, function (t, e) {
                    var n = e.name.match(o);
                    n
                        ? ((n = n[0]), a[n] || (a[n] = []), a[n].push(e.value))
                        : (a[e.name] = e.value);
                }),
                (t = a));
        var a,
            o,
            i,
            l = r.ajax,
            s = r.oInstance,
            u =
                (P.isPlainObject(l) &&
                    l.data &&
                    ((u = "function" == typeof (i = l.data) ? i(t, r) : i),
                    (t = "function" == typeof i && u ? u : P.extend(!0, t, u)),
                    delete l.data),
                {
                    data: t,
                    success: e,
                    dataType: "json",
                    cache: !1,
                    type: r.sServerMethod,
                    error: function (t, e, n) {
                        var a = R(r, null, "xhr", [r, null, r.jqXHR]);
                        -1 === P.inArray(!0, a) &&
                            ("parsererror" == e
                                ? W(r, 0, "Invalid JSON response", 1)
                                : 4 === t.readyState &&
                                  W(r, 0, "Ajax error", 7)),
                            D(r, !1);
                    },
                });
        (r.oAjaxData = t),
            R(r, null, "preXhr", [r, t]),
            r.fnServerData
                ? r.fnServerData.call(
                      s,
                      r.sAjaxSource,
                      P.map(t, function (t, e) {
                          return { name: e, value: t };
                      }),
                      e,
                      r
                  )
                : r.sAjaxSource || "string" == typeof l
                ? (r.jqXHR = P.ajax(P.extend(u, { url: l || r.sAjaxSource })))
                : "function" == typeof l
                ? (r.jqXHR = l.call(s, t, e, r))
                : ((r.jqXHR = P.ajax(P.extend(u, l))), (l.data = i));
    }
    function xt(e) {
        e.iDraw++, D(e, !0);
        var n = e._drawHold;
        Tt(e, At(e), function (t) {
            (e._drawHold = n), It(e, t), (e._drawHold = !1);
        });
    }
    function At(t) {
        for (
            var e,
                n,
                a,
                r = t.aoColumns,
                o = r.length,
                i = t.oFeatures,
                l = t.oPreviousSearch,
                s = t.aoPreSearchCols,
                u = [],
                c = I(t),
                f = t._iDisplayStart,
                d = !1 !== i.bPaginate ? t._iDisplayLength : -1,
                h = function (t, e) {
                    u.push({ name: t, value: e });
                },
                p =
                    (h("sEcho", t.iDraw),
                    h("iColumns", o),
                    h("sColumns", N(r, "sName").join(",")),
                    h("iDisplayStart", f),
                    h("iDisplayLength", d),
                    {
                        draw: t.iDraw,
                        columns: [],
                        order: [],
                        start: f,
                        length: d,
                        search: { value: l.sSearch, regex: l.bRegex },
                    }),
                g = 0;
            g < o;
            g++
        )
            (n = r[g]),
                (a = s[g]),
                (e = "function" == typeof n.mData ? "function" : n.mData),
                p.columns.push({
                    data: e,
                    name: n.sName,
                    searchable: n.bSearchable,
                    orderable: n.bSortable,
                    search: { value: a.sSearch, regex: a.bRegex },
                }),
                h("mDataProp_" + g, e),
                i.bFilter &&
                    (h("sSearch_" + g, a.sSearch),
                    h("bRegex_" + g, a.bRegex),
                    h("bSearchable_" + g, n.bSearchable)),
                i.bSort && h("bSortable_" + g, n.bSortable);
        i.bFilter && (h("sSearch", l.sSearch), h("bRegex", l.bRegex)),
            i.bSort &&
                (P.each(c, function (t, e) {
                    p.order.push({ column: e.col, dir: e.dir }),
                        h("iSortCol_" + t, e.col),
                        h("sSortDir_" + t, e.dir);
                }),
                h("iSortingCols", c.length));
        f = w.ext.legacy.ajax;
        return null === f ? (t.sAjaxSource ? u : p) : f ? u : p;
    }
    function It(t, n) {
        function e(t, e) {
            return n[t] !== H ? n[t] : n[e];
        }
        var a = Ft(t, n),
            r = e("sEcho", "draw"),
            o = e("iTotalRecords", "recordsTotal"),
            i = e("iTotalDisplayRecords", "recordsFiltered");
        if (r !== H) {
            if (+r < t.iDraw) return;
            t.iDraw = +r;
        }
        (a = a || []),
            pt(t),
            (t._iRecordsTotal = parseInt(o, 10)),
            (t._iRecordsDisplay = parseInt(i, 10));
        for (var l = 0, s = a.length; l < s; l++) x(t, a[l]);
        (t.aiDisplay = t.aiDisplayMaster.slice()),
            v(t, !0),
            t._bInitComplete || qt(t, n),
            D(t, !1);
    }
    function Ft(t, e, n) {
        t =
            P.isPlainObject(t.ajax) && t.ajax.dataSrc !== H
                ? t.ajax.dataSrc
                : t.sAjaxDataProp;
        if (!n) return "data" === t ? e.aaData || e[t] : "" !== t ? A(t)(e) : e;
        b(t)(e, n);
    }
    function Lt(n) {
        function e(t) {
            i.f;
            var e = this.value || "";
            (o.return && "Enter" !== t.key) ||
                (e != o.sSearch &&
                    (Rt(n, {
                        sSearch: e,
                        bRegex: o.bRegex,
                        bSmart: o.bSmart,
                        bCaseInsensitive: o.bCaseInsensitive,
                        return: o.return,
                    }),
                    (n._iDisplayStart = 0),
                    v(n)));
        }
        var t = n.oClasses,
            a = n.sTableId,
            r = n.oLanguage,
            o = n.oPreviousSearch,
            i = n.aanFeatures,
            l = '<input type="search" class="' + t.sFilterInput + '"/>',
            s = (s = r.sSearch).match(/_INPUT_/)
                ? s.replace("_INPUT_", l)
                : s + l,
            l = P("<div/>", {
                id: i.f ? null : a + "_filter",
                class: t.sFilter,
            }).append(P("<label/>").append(s)),
            t =
                null !== n.searchDelay
                    ? n.searchDelay
                    : "ssp" === E(n)
                    ? 400
                    : 0,
            u = P("input", l)
                .val(o.sSearch)
                .attr("placeholder", r.sSearchPlaceholder)
                .on(
                    "keyup.DT search.DT input.DT paste.DT cut.DT",
                    t ? ne(e, t) : e
                )
                .on("mouseup.DT", function (t) {
                    setTimeout(function () {
                        e.call(u[0], t);
                    }, 10);
                })
                .on("keypress.DT", function (t) {
                    if (13 == t.keyCode) return !1;
                })
                .attr("aria-controls", a);
        return (
            P(n.nTable).on("search.dt.DT", function (t, e) {
                if (n === e)
                    try {
                        u[0] !== y.activeElement && u.val(o.sSearch);
                    } catch (t) {}
            }),
            l[0]
        );
    }
    function Rt(t, e, n) {
        function a(t) {
            (o.sSearch = t.sSearch),
                (o.bRegex = t.bRegex),
                (o.bSmart = t.bSmart),
                (o.bCaseInsensitive = t.bCaseInsensitive),
                (o.return = t.return);
        }
        function r(t) {
            return t.bEscapeRegex !== H ? !t.bEscapeRegex : t.bRegex;
        }
        var o = t.oPreviousSearch,
            i = t.aoPreSearchCols;
        if ((lt(t), "ssp" != E(t))) {
            Ht(t, e.sSearch, n, r(e), e.bSmart, e.bCaseInsensitive), a(e);
            for (var l = 0; l < i.length; l++)
                jt(
                    t,
                    i[l].sSearch,
                    l,
                    r(i[l]),
                    i[l].bSmart,
                    i[l].bCaseInsensitive
                );
            Pt(t);
        } else a(e);
        (t.bFiltered = !0), R(t, null, "search", [t]);
    }
    function Pt(t) {
        for (
            var e, n, a = w.ext.search, r = t.aiDisplay, o = 0, i = a.length;
            o < i;
            o++
        ) {
            for (var l = [], s = 0, u = r.length; s < u; s++)
                (n = r[s]),
                    (e = t.aoData[n]),
                    a[o](t, e._aFilterData, n, e._aData, s) && l.push(n);
            (r.length = 0), P.merge(r, l);
        }
    }
    function jt(t, e, n, a, r, o) {
        if ("" !== e) {
            for (
                var i, l = [], s = t.aiDisplay, u = Nt(e, a, r, o), c = 0;
                c < s.length;
                c++
            )
                (i = t.aoData[s[c]]._aFilterData[n]), u.test(i) && l.push(s[c]);
            t.aiDisplay = l;
        }
    }
    function Ht(t, e, n, a, r, o) {
        var i,
            l,
            s,
            u = Nt(e, a, r, o),
            r = t.oPreviousSearch.sSearch,
            o = t.aiDisplayMaster,
            c = [];
        if ((0 !== w.ext.search.length && (n = !0), (l = Wt(t)), e.length <= 0))
            t.aiDisplay = o.slice();
        else {
            for (
                (l ||
                    n ||
                    a ||
                    r.length > e.length ||
                    0 !== e.indexOf(r) ||
                    t.bSorted) &&
                    (t.aiDisplay = o.slice()),
                    i = t.aiDisplay,
                    s = 0;
                s < i.length;
                s++
            )
                u.test(t.aoData[i[s]]._sFilterRow) && c.push(i[s]);
            t.aiDisplay = c;
        }
    }
    function Nt(t, e, n, a) {
        return (
            (t = e ? t : Ot(t)),
            n &&
                (t =
                    "^(?=.*?" +
                    P.map(
                        t.match(/["\u201C][^"\u201D]+["\u201D]|[^ ]+/g) || [""],
                        function (t) {
                            var e;
                            return (
                                '"' === t.charAt(0)
                                    ? (t = (e = t.match(/^"(.*)"$/)) ? e[1] : t)
                                    : "“" === t.charAt(0) &&
                                      (t = (e = t.match(/^\u201C(.*)\u201D$/))
                                          ? e[1]
                                          : t),
                                t.replace('"', "")
                            );
                        }
                    ).join(")(?=.*?") +
                    ").*$"),
            new RegExp(t, a ? "i" : "")
        );
    }
    var Ot = w.util.escapeRegex,
        kt = P("<div>")[0],
        Mt = kt.textContent !== H;
    function Wt(t) {
        for (
            var e,
                n,
                a,
                r,
                o,
                i = t.aoColumns,
                l = !1,
                s = 0,
                u = t.aoData.length;
            s < u;
            s++
        )
            if (!(o = t.aoData[s])._aFilterData) {
                for (a = [], e = 0, n = i.length; e < n; e++)
                    i[e].bSearchable
                        ? "string" !=
                              typeof (r =
                                  null === (r = S(t, s, e, "filter"))
                                      ? ""
                                      : r) &&
                          r.toString &&
                          (r = r.toString())
                        : (r = ""),
                        r.indexOf &&
                            -1 !== r.indexOf("&") &&
                            ((kt.innerHTML = r),
                            (r = Mt ? kt.textContent : kt.innerText)),
                        r.replace && (r = r.replace(/[\r\n\u2028]/g, "")),
                        a.push(r);
                (o._aFilterData = a), (o._sFilterRow = a.join("  ")), (l = !0);
            }
        return l;
    }
    function Et(t) {
        return {
            search: t.sSearch,
            smart: t.bSmart,
            regex: t.bRegex,
            caseInsensitive: t.bCaseInsensitive,
        };
    }
    function Bt(t) {
        return {
            sSearch: t.search,
            bSmart: t.smart,
            bRegex: t.regex,
            bCaseInsensitive: t.caseInsensitive,
        };
    }
    function Ut(t) {
        var e = t.sTableId,
            n = t.aanFeatures.i,
            a = P("<div/>", {
                class: t.oClasses.sInfo,
                id: n ? null : e + "_info",
            });
        return (
            n ||
                (t.aoDrawCallback.push({ fn: Vt, sName: "information" }),
                a.attr("role", "status").attr("aria-live", "polite"),
                P(t.nTable).attr("aria-describedby", e + "_info")),
            a[0]
        );
    }
    function Vt(t) {
        var e,
            n,
            a,
            r,
            o,
            i,
            l = t.aanFeatures.i;
        0 !== l.length &&
            ((i = t.oLanguage),
            (e = t._iDisplayStart + 1),
            (n = t.fnDisplayEnd()),
            (a = t.fnRecordsTotal()),
            (o = (r = t.fnRecordsDisplay()) ? i.sInfo : i.sInfoEmpty),
            r !== a && (o += " " + i.sInfoFiltered),
            (o = Xt(t, (o += i.sInfoPostFix))),
            null !== (i = i.fnInfoCallback) &&
                (o = i.call(t.oInstance, t, e, n, a, r, o)),
            P(l).html(o));
    }
    function Xt(t, e) {
        var n = t.fnFormatNumber,
            a = t._iDisplayStart + 1,
            r = t._iDisplayLength,
            o = t.fnRecordsDisplay(),
            i = -1 === r;
        return e
            .replace(/_START_/g, n.call(t, a))
            .replace(/_END_/g, n.call(t, t.fnDisplayEnd()))
            .replace(/_MAX_/g, n.call(t, t.fnRecordsTotal()))
            .replace(/_TOTAL_/g, n.call(t, o))
            .replace(/_PAGE_/g, n.call(t, i ? 1 : Math.ceil(a / r)))
            .replace(/_PAGES_/g, n.call(t, i ? 1 : Math.ceil(o / r)));
    }
    function Jt(n) {
        var a,
            t,
            e,
            r = n.iInitDisplayStart,
            o = n.aoColumns,
            i = n.oFeatures,
            l = n.bDeferLoading;
        if (n.bInitialised) {
            for (
                _t(n),
                    yt(n),
                    Dt(n, n.aoHeader),
                    Dt(n, n.aoFooter),
                    D(n, !0),
                    i.bAutoWidth && ee(n),
                    a = 0,
                    t = o.length;
                a < t;
                a++
            )
                (e = o[a]).sWidth && (e.nTh.style.width = M(e.sWidth));
            R(n, null, "preInit", [n]), u(n);
            i = E(n);
            ("ssp" == i && !l) ||
                ("ajax" == i
                    ? Tt(n, [], function (t) {
                          var e = Ft(n, t);
                          for (a = 0; a < e.length; a++) x(n, e[a]);
                          (n.iInitDisplayStart = r), u(n), D(n, !1), qt(n, t);
                      })
                    : (D(n, !1), qt(n)));
        } else
            setTimeout(function () {
                Jt(n);
            }, 200);
    }
    function qt(t, e) {
        (t._bInitComplete = !0),
            (e || t.oInit.aaData) && O(t),
            R(t, null, "plugin-init", [t, e]),
            R(t, "aoInitComplete", "init", [t, e]);
    }
    function $t(t, e) {
        e = parseInt(e, 10);
        (t._iDisplayLength = e), Se(t), R(t, null, "length", [t, e]);
    }
    function Gt(a) {
        for (
            var t = a.oClasses,
                e = a.sTableId,
                n = a.aLengthMenu,
                r = Array.isArray(n[0]),
                o = r ? n[0] : n,
                i = r ? n[1] : n,
                l = P("<select/>", {
                    name: e + "_length",
                    "aria-controls": e,
                    class: t.sLengthSelect,
                }),
                s = 0,
                u = o.length;
            s < u;
            s++
        )
            l[0][s] = new Option(
                "number" == typeof i[s] ? a.fnFormatNumber(i[s]) : i[s],
                o[s]
            );
        var c = P("<div><label/></div>").addClass(t.sLength);
        return (
            a.aanFeatures.l || (c[0].id = e + "_length"),
            c
                .children()
                .append(
                    a.oLanguage.sLengthMenu.replace("_MENU_", l[0].outerHTML)
                ),
            P("select", c)
                .val(a._iDisplayLength)
                .on("change.DT", function (t) {
                    $t(a, P(this).val()), v(a);
                }),
            P(a.nTable).on("length.dt.DT", function (t, e, n) {
                a === e && P("select", c).val(n);
            }),
            c[0]
        );
    }
    function zt(t) {
        function c(t) {
            v(t);
        }
        var e = t.sPaginationType,
            f = w.ext.pager[e],
            d = "function" == typeof f,
            e = P("<div/>").addClass(t.oClasses.sPaging + e)[0],
            h = t.aanFeatures;
        return (
            d || f.fnInit(t, e, c),
            h.p ||
                ((e.id = t.sTableId + "_paginate"),
                t.aoDrawCallback.push({
                    fn: function (t) {
                        if (d)
                            for (
                                var e = t._iDisplayStart,
                                    n = t._iDisplayLength,
                                    a = t.fnRecordsDisplay(),
                                    r = -1 === n,
                                    o = r ? 0 : Math.ceil(e / n),
                                    i = r ? 1 : Math.ceil(a / n),
                                    l = f(o, i),
                                    s = 0,
                                    u = h.p.length;
                                s < u;
                                s++
                            )
                                ve(t, "pageButton")(t, h.p[s], s, l, o, i);
                        else f.fnUpdate(t, c);
                    },
                    sName: "pagination",
                })),
            e
        );
    }
    function Yt(t, e, n) {
        var a = t._iDisplayStart,
            r = t._iDisplayLength,
            o = t.fnRecordsDisplay(),
            o =
                (0 === o || -1 === r
                    ? (a = 0)
                    : "number" == typeof e
                    ? o < (a = e * r) && (a = 0)
                    : "first" == e
                    ? (a = 0)
                    : "previous" == e
                    ? (a = 0 <= r ? a - r : 0) < 0 && (a = 0)
                    : "next" == e
                    ? a + r < o && (a += r)
                    : "last" == e
                    ? (a = Math.floor((o - 1) / r) * r)
                    : W(t, 0, "Unknown paging action: " + e, 5),
                t._iDisplayStart !== a);
        return (
            (t._iDisplayStart = a),
            o
                ? (R(t, null, "page", [t]), n && v(t))
                : R(t, null, "page-nc", [t]),
            o
        );
    }
    function Zt(t) {
        return P("<div/>", {
            id: t.aanFeatures.r ? null : t.sTableId + "_processing",
            class: t.oClasses.sProcessing,
            role: "status",
        })
            .html(t.oLanguage.sProcessing)
            .append("<div><div></div><div></div><div></div><div></div></div>")
            .insertBefore(t.nTable)[0];
    }
    function D(t, e) {
        t.oFeatures.bProcessing &&
            P(t.aanFeatures.r).css("display", e ? "block" : "none"),
            R(t, null, "processing", [t, e]);
    }
    function Kt(t) {
        var e,
            n,
            a,
            r,
            o,
            i,
            l,
            s,
            u,
            c,
            f,
            d,
            h = P(t.nTable),
            p = t.oScroll;
        return "" === p.sX && "" === p.sY
            ? t.nTable
            : ((e = p.sX),
              (n = p.sY),
              (a = t.oClasses),
              (o = (r = h.children("caption")).length
                  ? r[0]._captionSide
                  : null),
              (s = P(h[0].cloneNode(!1))),
              (i = P(h[0].cloneNode(!1))),
              (u = function (t) {
                  return t ? M(t) : null;
              }),
              (l = h.children("tfoot")).length || (l = null),
              (s = P((f = "<div/>"), { class: a.sScrollWrapper })
                  .append(
                      P(f, { class: a.sScrollHead })
                          .css({
                              overflow: "hidden",
                              position: "relative",
                              border: 0,
                              width: e ? u(e) : "100%",
                          })
                          .append(
                              P(f, { class: a.sScrollHeadInner })
                                  .css({
                                      "box-sizing": "content-box",
                                      width: p.sXInner || "100%",
                                  })
                                  .append(
                                      s
                                          .removeAttr("id")
                                          .css("margin-left", 0)
                                          .append("top" === o ? r : null)
                                          .append(h.children("thead"))
                                  )
                          )
                  )
                  .append(
                      P(f, { class: a.sScrollBody })
                          .css({
                              position: "relative",
                              overflow: "auto",
                              width: u(e),
                          })
                          .append(h)
                  )),
              l &&
                  s.append(
                      P(f, { class: a.sScrollFoot })
                          .css({
                              overflow: "hidden",
                              border: 0,
                              width: e ? u(e) : "100%",
                          })
                          .append(
                              P(f, { class: a.sScrollFootInner }).append(
                                  i
                                      .removeAttr("id")
                                      .css("margin-left", 0)
                                      .append("bottom" === o ? r : null)
                                      .append(h.children("tfoot"))
                              )
                          )
                  ),
              (u = s.children()),
              (c = u[0]),
              (f = u[1]),
              (d = l ? u[2] : null),
              e &&
                  P(f).on("scroll.DT", function (t) {
                      var e = this.scrollLeft;
                      (c.scrollLeft = e), l && (d.scrollLeft = e);
                  }),
              P(f).css("max-height", n),
              p.bCollapse || P(f).css("height", n),
              (t.nScrollHead = c),
              (t.nScrollBody = f),
              (t.nScrollFoot = d),
              t.aoDrawCallback.push({ fn: Qt, sName: "scrolling" }),
              s[0]);
    }
    function Qt(n) {
        function t(t) {
            ((t = t.style).paddingTop = "0"),
                (t.paddingBottom = "0"),
                (t.borderTopWidth = "0"),
                (t.borderBottomWidth = "0"),
                (t.height = 0);
        }
        var e,
            a,
            r,
            o,
            i,
            l = n.oScroll,
            s = l.sX,
            u = l.sXInner,
            c = l.sY,
            l = l.iBarWidth,
            f = P(n.nScrollHead),
            d = f[0].style,
            h = f.children("div"),
            p = h[0].style,
            h = h.children("table"),
            g = n.nScrollBody,
            b = P(g),
            m = g.style,
            S = P(n.nScrollFoot).children("div"),
            v = S.children("table"),
            y = P(n.nTHead),
            D = P(n.nTable),
            _ = D[0],
            w = _.style,
            C = n.nTFoot ? P(n.nTFoot) : null,
            T = n.oBrowser,
            x = T.bScrollOversize,
            A = (N(n.aoColumns, "nTh"), []),
            I = [],
            F = [],
            L = [],
            R = g.scrollHeight > g.clientHeight;
        n.scrollBarVis !== R && n.scrollBarVis !== H
            ? ((n.scrollBarVis = R), O(n))
            : ((n.scrollBarVis = R),
              D.children("thead, tfoot").remove(),
              C &&
                  ((R = C.clone().prependTo(D)),
                  (i = C.find("tr")),
                  (a = R.find("tr")),
                  R.find("[id]").removeAttr("id")),
              (R = y.clone().prependTo(D)),
              (y = y.find("tr")),
              (e = R.find("tr")),
              R.find("th, td").removeAttr("tabindex"),
              R.find("[id]").removeAttr("id"),
              s || ((m.width = "100%"), (f[0].style.width = "100%")),
              P.each(Ct(n, R), function (t, e) {
                  (r = rt(n, t)), (e.style.width = n.aoColumns[r].sWidth);
              }),
              C &&
                  k(function (t) {
                      t.style.width = "";
                  }, a),
              (f = D.outerWidth()),
              "" === s
                  ? ((w.width = "100%"),
                    x &&
                        (D.find("tbody").height() > g.offsetHeight ||
                            "scroll" == b.css("overflow-y")) &&
                        (w.width = M(D.outerWidth() - l)),
                    (f = D.outerWidth()))
                  : "" !== u && ((w.width = M(u)), (f = D.outerWidth())),
              k(t, e),
              k(function (t) {
                  var e = j.getComputedStyle
                      ? j.getComputedStyle(t).width
                      : M(P(t).width());
                  F.push(t.innerHTML), A.push(e);
              }, e),
              k(function (t, e) {
                  t.style.width = A[e];
              }, y),
              P(e).css("height", 0),
              C &&
                  (k(t, a),
                  k(function (t) {
                      L.push(t.innerHTML), I.push(M(P(t).css("width")));
                  }, a),
                  k(function (t, e) {
                      t.style.width = I[e];
                  }, i),
                  P(a).height(0)),
              k(function (t, e) {
                  (t.innerHTML =
                      '<div class="dataTables_sizing">' + F[e] + "</div>"),
                      (t.childNodes[0].style.height = "0"),
                      (t.childNodes[0].style.overflow = "hidden"),
                      (t.style.width = A[e]);
              }, e),
              C &&
                  k(function (t, e) {
                      (t.innerHTML =
                          '<div class="dataTables_sizing">' + L[e] + "</div>"),
                          (t.childNodes[0].style.height = "0"),
                          (t.childNodes[0].style.overflow = "hidden"),
                          (t.style.width = I[e]);
                  }, a),
              Math.round(D.outerWidth()) < Math.round(f)
                  ? ((o =
                        g.scrollHeight > g.offsetHeight ||
                        "scroll" == b.css("overflow-y")
                            ? f + l
                            : f),
                    x &&
                        (g.scrollHeight > g.offsetHeight ||
                            "scroll" == b.css("overflow-y")) &&
                        (w.width = M(o - l)),
                    ("" !== s && "" === u) ||
                        W(n, 1, "Possible column misalignment", 6))
                  : (o = "100%"),
              (m.width = M(o)),
              (d.width = M(o)),
              C && (n.nScrollFoot.style.width = M(o)),
              c || (x && (m.height = M(_.offsetHeight + l))),
              (R = D.outerWidth()),
              (h[0].style.width = M(R)),
              (p.width = M(R)),
              (y =
                  D.height() > g.clientHeight ||
                  "scroll" == b.css("overflow-y")),
              (p[(i = "padding" + (T.bScrollbarLeft ? "Left" : "Right"))] = y
                  ? l + "px"
                  : "0px"),
              C &&
                  ((v[0].style.width = M(R)),
                  (S[0].style.width = M(R)),
                  (S[0].style[i] = y ? l + "px" : "0px")),
              D.children("colgroup").insertBefore(D.children("thead")),
              b.trigger("scroll"),
              (!n.bSorted && !n.bFiltered) || n._drawHold || (g.scrollTop = 0));
    }
    function k(t, e, n) {
        for (var a, r, o = 0, i = 0, l = e.length; i < l; ) {
            for (a = e[i].firstChild, r = n ? n[i].firstChild : null; a; )
                1 === a.nodeType && (n ? t(a, r, o) : t(a, o), o++),
                    (a = a.nextSibling),
                    (r = n ? r.nextSibling : null);
            i++;
        }
    }
    var te = /<.*?>/g;
    function ee(t) {
        var e,
            n,
            a = t.nTable,
            r = t.aoColumns,
            o = t.oScroll,
            i = o.sY,
            l = o.sX,
            o = o.sXInner,
            s = r.length,
            u = it(t, "bVisible"),
            c = P("th", t.nTHead),
            f = a.getAttribute("width"),
            d = a.parentNode,
            h = !1,
            p = t.oBrowser,
            g = p.bScrollOversize,
            b = a.style.width;
        for (b && -1 !== b.indexOf("%") && (f = b), D = 0; D < u.length; D++)
            null !== (e = r[u[D]]).sWidth &&
                ((e.sWidth = ae(e.sWidthOrig, d)), (h = !0));
        if (g || (!h && !l && !i && s == T(t) && s == c.length))
            for (D = 0; D < s; D++) {
                var m = rt(t, D);
                null !== m && (r[m].sWidth = M(c.eq(D).width()));
            }
        else {
            var b = P(a).clone().css("visibility", "hidden").removeAttr("id"),
                S =
                    (b.find("tbody tr").remove(),
                    P("<tr/>").appendTo(b.find("tbody")));
            for (
                b.find("thead, tfoot").remove(),
                    b.append(P(t.nTHead).clone()).append(P(t.nTFoot).clone()),
                    b.find("tfoot th, tfoot td").css("width", ""),
                    c = Ct(t, b.find("thead")[0]),
                    D = 0;
                D < u.length;
                D++
            )
                (e = r[u[D]]),
                    (c[D].style.width =
                        null !== e.sWidthOrig && "" !== e.sWidthOrig
                            ? M(e.sWidthOrig)
                            : ""),
                    e.sWidthOrig &&
                        l &&
                        P(c[D]).append(
                            P("<div/>").css({
                                width: e.sWidthOrig,
                                margin: 0,
                                padding: 0,
                                border: 0,
                                height: 1,
                            })
                        );
            if (t.aoData.length)
                for (D = 0; D < u.length; D++)
                    (e = r[(n = u[D])]),
                        P(re(t, n))
                            .clone(!1)
                            .append(e.sContentPadding)
                            .appendTo(S);
            P("[name]", b).removeAttr("name");
            for (
                var v = P("<div/>")
                        .css(
                            l || i
                                ? {
                                      position: "absolute",
                                      top: 0,
                                      left: 0,
                                      height: 1,
                                      right: 0,
                                      overflow: "hidden",
                                  }
                                : {}
                        )
                        .append(b)
                        .appendTo(d),
                    y =
                        (l && o
                            ? b.width(o)
                            : l
                            ? (b.css("width", "auto"),
                              b.removeAttr("width"),
                              b.width() < d.clientWidth &&
                                  f &&
                                  b.width(d.clientWidth))
                            : i
                            ? b.width(d.clientWidth)
                            : f && b.width(f),
                        0),
                    D = 0;
                D < u.length;
                D++
            ) {
                var _ = P(c[D]),
                    w = _.outerWidth() - _.width(),
                    _ = p.bBounding
                        ? Math.ceil(c[D].getBoundingClientRect().width)
                        : _.outerWidth();
                (y += _), (r[u[D]].sWidth = M(_ - w));
            }
            (a.style.width = M(y)), v.remove();
        }
        f && (a.style.width = M(f)),
            (!f && !l) ||
                t._reszEvt ||
                ((o = function () {
                    P(j).on(
                        "resize.DT-" + t.sInstance,
                        ne(function () {
                            O(t);
                        })
                    );
                }),
                g ? setTimeout(o, 1e3) : o(),
                (t._reszEvt = !0));
    }
    var ne = w.util.throttle;
    function ae(t, e) {
        return t
            ? ((e = (t = P("<div/>")
                  .css("width", M(t))
                  .appendTo(e || y.body))[0].offsetWidth),
              t.remove(),
              e)
            : 0;
    }
    function re(t, e) {
        var n,
            a = oe(t, e);
        return a < 0
            ? null
            : (n = t.aoData[a]).nTr
            ? n.anCells[e]
            : P("<td/>").html(S(t, a, e, "display"))[0];
    }
    function oe(t, e) {
        for (var n, a = -1, r = -1, o = 0, i = t.aoData.length; o < i; o++)
            (n = (n = (n = S(t, o, e, "display") + "").replace(te, "")).replace(
                /&nbsp;/g,
                " "
            )).length > a && ((a = n.length), (r = o));
        return r;
    }
    function M(t) {
        return null === t
            ? "0px"
            : "number" == typeof t
            ? t < 0
                ? "0px"
                : t + "px"
            : t.match(/\d$/)
            ? t + "px"
            : t;
    }
    function I(t) {
        function e(t) {
            t.length && !Array.isArray(t[0]) ? h.push(t) : P.merge(h, t);
        }
        var n,
            a,
            r,
            o,
            i,
            l,
            s,
            u = [],
            c = t.aoColumns,
            f = t.aaSortingFixed,
            d = P.isPlainObject(f),
            h = [];
        for (
            Array.isArray(f) && e(f),
                d && f.pre && e(f.pre),
                e(t.aaSorting),
                d && f.post && e(f.post),
                n = 0;
            n < h.length;
            n++
        )
            for (r = (o = c[(s = h[n][(a = 0)])].aDataSort).length; a < r; a++)
                (l = c[(i = o[a])].sType || "string"),
                    h[n]._idx === H &&
                        (h[n]._idx = P.inArray(h[n][1], c[i].asSorting)),
                    u.push({
                        src: s,
                        col: i,
                        dir: h[n][1],
                        index: h[n]._idx,
                        type: l,
                        formatter: w.ext.type.order[l + "-pre"],
                    });
        return u;
    }
    function ie(t) {
        var e,
            n,
            a,
            r,
            c,
            f = [],
            u = w.ext.type.order,
            d = t.aoData,
            o = (t.aoColumns, 0),
            i = t.aiDisplayMaster;
        for (lt(t), e = 0, n = (c = I(t)).length; e < n; e++)
            (r = c[e]).formatter && o++, fe(t, r.col);
        if ("ssp" != E(t) && 0 !== c.length) {
            for (e = 0, a = i.length; e < a; e++) f[i[e]] = e;
            o === c.length
                ? i.sort(function (t, e) {
                      for (
                          var n,
                              a,
                              r,
                              o,
                              i = c.length,
                              l = d[t]._aSortData,
                              s = d[e]._aSortData,
                              u = 0;
                          u < i;
                          u++
                      )
                          if (
                              0 !=
                              (r =
                                  (n = l[(o = c[u]).col]) < (a = s[o.col])
                                      ? -1
                                      : a < n
                                      ? 1
                                      : 0)
                          )
                              return "asc" === o.dir ? r : -r;
                      return (n = f[t]) < (a = f[e]) ? -1 : a < n ? 1 : 0;
                  })
                : i.sort(function (t, e) {
                      for (
                          var n,
                              a,
                              r,
                              o = c.length,
                              i = d[t]._aSortData,
                              l = d[e]._aSortData,
                              s = 0;
                          s < o;
                          s++
                      )
                          if (
                              ((n = i[(r = c[s]).col]),
                              (a = l[r.col]),
                              0 !==
                                  (r = (
                                      u[r.type + "-" + r.dir] ||
                                      u["string-" + r.dir]
                                  )(n, a)))
                          )
                              return r;
                      return (n = f[t]) < (a = f[e]) ? -1 : a < n ? 1 : 0;
                  });
        }
        t.bSorted = !0;
    }
    function le(t) {
        for (
            var e = t.aoColumns,
                n = I(t),
                a = t.oLanguage.oAria,
                r = 0,
                o = e.length;
            r < o;
            r++
        ) {
            var i = e[r],
                l = i.asSorting,
                s = i.ariaTitle || i.sTitle.replace(/<.*?>/g, ""),
                u = i.nTh;
            u.removeAttribute("aria-sort"),
                (i = i.bSortable
                    ? s +
                      ("asc" ===
                      ((0 < n.length &&
                          n[0].col == r &&
                          (u.setAttribute(
                              "aria-sort",
                              "asc" == n[0].dir ? "ascending" : "descending"
                          ),
                          l[n[0].index + 1])) ||
                          l[0])
                          ? a.sSortAscending
                          : a.sSortDescending)
                    : s),
                u.setAttribute("aria-label", i);
        }
    }
    function se(t, e, n, a) {
        function r(t, e) {
            var n = t._idx;
            return (n = n === H ? P.inArray(t[1], s) : n) + 1 < s.length
                ? n + 1
                : e
                ? null
                : 0;
        }
        var o,
            i = t.aoColumns[e],
            l = t.aaSorting,
            s = i.asSorting;
        "number" == typeof l[0] && (l = t.aaSorting = [l]),
            n && t.oFeatures.bSortMulti
                ? -1 !== (i = P.inArray(e, N(l, "0")))
                    ? null ===
                      (o = null === (o = r(l[i], !0)) && 1 === l.length ? 0 : o)
                        ? l.splice(i, 1)
                        : ((l[i][1] = s[o]), (l[i]._idx = o))
                    : (l.push([e, s[0], 0]), (l[l.length - 1]._idx = 0))
                : l.length && l[0][0] == e
                ? ((o = r(l[0])),
                  (l.length = 1),
                  (l[0][1] = s[o]),
                  (l[0]._idx = o))
                : ((l.length = 0), l.push([e, s[0]]), (l[0]._idx = 0)),
            u(t),
            "function" == typeof a && a(t);
    }
    function ue(e, t, n, a) {
        var r = e.aoColumns[n];
        me(t, {}, function (t) {
            !1 !== r.bSortable &&
                (e.oFeatures.bProcessing
                    ? (D(e, !0),
                      setTimeout(function () {
                          se(e, n, t.shiftKey, a), "ssp" !== E(e) && D(e, !1);
                      }, 0))
                    : se(e, n, t.shiftKey, a));
        });
    }
    function ce(t) {
        var e,
            n,
            a,
            r = t.aLastSort,
            o = t.oClasses.sSortColumn,
            i = I(t),
            l = t.oFeatures;
        if (l.bSort && l.bSortClasses) {
            for (e = 0, n = r.length; e < n; e++)
                (a = r[e].src),
                    P(N(t.aoData, "anCells", a)).removeClass(
                        o + (e < 2 ? e + 1 : 3)
                    );
            for (e = 0, n = i.length; e < n; e++)
                (a = i[e].src),
                    P(N(t.aoData, "anCells", a)).addClass(
                        o + (e < 2 ? e + 1 : 3)
                    );
        }
        t.aLastSort = i;
    }
    function fe(t, e) {
        for (
            var n,
                a,
                r,
                o = t.aoColumns[e],
                i = w.ext.order[o.sSortDataType],
                l =
                    (i && (n = i.call(t.oInstance, t, e, ot(t, e))),
                    w.ext.type.order[o.sType + "-pre"]),
                s = 0,
                u = t.aoData.length;
            s < u;
            s++
        )
            (a = t.aoData[s])._aSortData || (a._aSortData = []),
                (a._aSortData[e] && !i) ||
                    ((r = i ? n[s] : S(t, s, e, "sort")),
                    (a._aSortData[e] = l ? l(r) : r));
    }
    function de(n) {
        var t;
        n._bLoadingState ||
            ((t = {
                time: +new Date(),
                start: n._iDisplayStart,
                length: n._iDisplayLength,
                order: P.extend(!0, [], n.aaSorting),
                search: Et(n.oPreviousSearch),
                columns: P.map(n.aoColumns, function (t, e) {
                    return {
                        visible: t.bVisible,
                        search: Et(n.aoPreSearchCols[e]),
                    };
                }),
            }),
            (n.oSavedState = t),
            R(n, "aoStateSaveParams", "stateSaveParams", [n, t]),
            n.oFeatures.bStateSave &&
                !n.bDestroying &&
                n.fnStateSaveCallback.call(n.oInstance, n, t));
    }
    function he(e, t, n) {
        var a;
        if (e.oFeatures.bStateSave)
            return (
                (a = e.fnStateLoadCallback.call(e.oInstance, e, function (t) {
                    pe(e, t, n);
                })) !== H && pe(e, a, n),
                !0
            );
        n();
    }
    function pe(n, t, e) {
        var a,
            r,
            o = n.aoColumns,
            i =
                ((n._bLoadingState = !0),
                n._bInitComplete ? new w.Api(n) : null);
        if (t && t.time) {
            var l = R(n, "aoStateLoadParams", "stateLoadParams", [n, t]);
            if (-1 !== P.inArray(!1, l)) n._bLoadingState = !1;
            else {
                l = n.iStateDuration;
                if (0 < l && t.time < +new Date() - 1e3 * l)
                    n._bLoadingState = !1;
                else if (t.columns && o.length !== t.columns.length)
                    n._bLoadingState = !1;
                else {
                    if (
                        ((n.oLoadedState = P.extend(!0, {}, t)),
                        t.length !== H &&
                            (i
                                ? i.page.len(t.length)
                                : (n._iDisplayLength = t.length)),
                        t.start !== H &&
                            (null === i
                                ? ((n._iDisplayStart = t.start),
                                  (n.iInitDisplayStart = t.start))
                                : Yt(n, t.start / n._iDisplayLength)),
                        t.order !== H &&
                            ((n.aaSorting = []),
                            P.each(t.order, function (t, e) {
                                n.aaSorting.push(
                                    e[0] >= o.length ? [0, e[1]] : e
                                );
                            })),
                        t.search !== H &&
                            P.extend(n.oPreviousSearch, Bt(t.search)),
                        t.columns)
                    ) {
                        for (a = 0, r = t.columns.length; a < r; a++) {
                            var s = t.columns[a];
                            s.visible !== H &&
                                (i
                                    ? i.column(a).visible(s.visible, !1)
                                    : (o[a].bVisible = s.visible)),
                                s.search !== H &&
                                    P.extend(
                                        n.aoPreSearchCols[a],
                                        Bt(s.search)
                                    );
                        }
                        i && i.columns.adjust();
                    }
                    (n._bLoadingState = !1),
                        R(n, "aoStateLoaded", "stateLoaded", [n, t]);
                }
            }
        } else n._bLoadingState = !1;
        e();
    }
    function ge(t) {
        var e = w.settings,
            t = P.inArray(t, N(e, "nTable"));
        return -1 !== t ? e[t] : null;
    }
    function W(t, e, n, a) {
        if (
            ((n =
                "DataTables warning: " +
                (t ? "table id=" + t.sTableId + " - " : "") +
                n),
            a &&
                (n +=
                    ". For more information about this error, please see http://datatables.net/tn/" +
                    a),
            e)
        )
            j.console && console.log && console.log(n);
        else {
            (e = w.ext), (e = e.sErrMode || e.errMode);
            if ((t && R(t, null, "error", [t, a, n]), "alert" == e)) alert(n);
            else {
                if ("throw" == e) throw new Error(n);
                "function" == typeof e && e(t, a, n);
            }
        }
    }
    function F(n, a, t, e) {
        Array.isArray(t)
            ? P.each(t, function (t, e) {
                  Array.isArray(e) ? F(n, a, e[0], e[1]) : F(n, a, e);
              })
            : (e === H && (e = t), a[t] !== H && (n[e] = a[t]));
    }
    function be(t, e, n) {
        var a, r;
        for (r in e)
            e.hasOwnProperty(r) &&
                ((a = e[r]),
                P.isPlainObject(a)
                    ? (P.isPlainObject(t[r]) || (t[r] = {}),
                      P.extend(!0, t[r], a))
                    : n && "data" !== r && "aaData" !== r && Array.isArray(a)
                    ? (t[r] = a.slice())
                    : (t[r] = a));
        return t;
    }
    function me(e, t, n) {
        P(e)
            .on("click.DT", t, function (t) {
                P(e).trigger("blur"), n(t);
            })
            .on("keypress.DT", t, function (t) {
                13 === t.which && (t.preventDefault(), n(t));
            })
            .on("selectstart.DT", function () {
                return !1;
            });
    }
    function L(t, e, n, a) {
        n && t[e].push({ fn: n, sName: a });
    }
    function R(n, t, e, a) {
        var r = [];
        return (
            t &&
                (r = P.map(n[t].slice().reverse(), function (t, e) {
                    return t.fn.apply(n.oInstance, a);
                })),
            null !== e &&
                ((t = P.Event(e + ".dt")),
                (e = P(n.nTable)).trigger(t, a),
                0 === e.parents("body").length && P("body").trigger(t, a),
                r.push(t.result)),
            r
        );
    }
    function Se(t) {
        var e = t._iDisplayStart,
            n = t.fnDisplayEnd(),
            a = t._iDisplayLength;
        n <= e && (e = n - a),
            (e -= e % a),
            (t._iDisplayStart = e = -1 === a || e < 0 ? 0 : e);
    }
    function ve(t, e) {
        var t = t.renderer,
            n = w.ext.renderer[e];
        return P.isPlainObject(t) && t[e]
            ? n[t[e]] || n._
            : ("string" == typeof t && n[t]) || n._;
    }
    function E(t) {
        return t.oFeatures.bServerSide
            ? "ssp"
            : t.ajax || t.sAjaxSource
            ? "ajax"
            : "dom";
    }
    function ye(t, n) {
        var a;
        return Array.isArray(t)
            ? P.map(t, function (t) {
                  return ye(t, n);
              })
            : "number" == typeof t
            ? [n[t]]
            : ((a = P.map(n, function (t, e) {
                  return t.nTable;
              })),
              P(a)
                  .filter(t)
                  .map(function (t) {
                      var e = P.inArray(this, a);
                      return n[e];
                  })
                  .toArray());
    }
    function De(r, o, t) {
        var e, n;
        t &&
            (e = new B(r)).one("draw", function () {
                t(e.ajax.json());
            }),
            "ssp" == E(r)
                ? u(r, o)
                : (D(r, !0),
                  (n = r.jqXHR) && 4 !== n.readyState && n.abort(),
                  Tt(r, [], function (t) {
                      pt(r);
                      for (var e = Ft(r, t), n = 0, a = e.length; n < a; n++)
                          x(r, e[n]);
                      u(r, o), D(r, !1);
                  }));
    }
    function _e(t, e, n, a, r) {
        for (
            var o,
                i,
                l,
                s,
                u = [],
                c = typeof e,
                f = 0,
                d = (e =
                    e && "string" != c && "function" != c && e.length !== H
                        ? e
                        : [e]).length;
            f < d;
            f++
        )
            for (
                l = 0,
                    s = (i =
                        e[f] && e[f].split && !e[f].match(/[\[\(:]/)
                            ? e[f].split(",")
                            : [e[f]]).length;
                l < s;
                l++
            )
                (o = n("string" == typeof i[l] ? i[l].trim() : i[l])) &&
                    o.length &&
                    (u = u.concat(o));
        var h = p.selector[t];
        if (h.length) for (f = 0, d = h.length; f < d; f++) u = h[f](a, r, u);
        return z(u);
    }
    function we(t) {
        return (
            (t = t || {}).filter && t.search === H && (t.search = t.filter),
            P.extend({ search: "none", order: "current", page: "all" }, t)
        );
    }
    function Ce(t) {
        for (var e = 0, n = t.length; e < n; e++)
            if (0 < t[e].length)
                return (
                    (t[0] = t[e]),
                    (t[0].length = 1),
                    (t.length = 1),
                    (t.context = [t.context[e]]),
                    t
                );
        return (t.length = 0), t;
    }
    function Te(o, t, e, n) {
        function i(t, e) {
            var n;
            if (Array.isArray(t) || t instanceof P)
                for (var a = 0, r = t.length; a < r; a++) i(t[a], e);
            else
                t.nodeName && "tr" === t.nodeName.toLowerCase()
                    ? l.push(t)
                    : ((n = P("<tr><td></td></tr>").addClass(e)),
                      (P("td", n).addClass(e).html(t)[0].colSpan = T(o)),
                      l.push(n[0]));
        }
        var l = [];
        i(e, n),
            t._details && t._details.detach(),
            (t._details = P(l)),
            t._detailsShow && t._details.insertAfter(t.nTr);
    }
    function xe(t, e) {
        var n = t.context;
        if (n.length && t.length) {
            var a = n[0].aoData[t[0]];
            if (a._details) {
                (a._detailsShow = e)
                    ? (a._details.insertAfter(a.nTr),
                      P(a.nTr).addClass("dt-hasChild"))
                    : (a._details.detach(),
                      P(a.nTr).removeClass("dt-hasChild")),
                    R(n[0], null, "childRow", [e, t.row(t[0])]);
                var s = n[0],
                    r = new B(s),
                    a = ".dt.DT_details",
                    e = "draw" + a,
                    t = "column-sizing" + a,
                    a = "destroy" + a,
                    u = s.aoData;
                if (
                    (r.off(e + " " + t + " " + a), N(u, "_details").length > 0)
                ) {
                    r.on(e, function (t, e) {
                        if (s !== e) return;
                        r.rows({ page: "current" })
                            .eq(0)
                            .each(function (t) {
                                var e = u[t];
                                if (e._detailsShow)
                                    e._details.insertAfter(e.nTr);
                            });
                    });
                    r.on(t, function (t, e, n, a) {
                        if (s !== e) return;
                        var r,
                            o = T(e);
                        for (var i = 0, l = u.length; i < l; i++) {
                            r = u[i];
                            if (r._details)
                                r._details
                                    .children("td[colspan]")
                                    .attr("colspan", o);
                        }
                    });
                    r.on(a, function (t, e) {
                        if (s !== e) return;
                        for (var n = 0, a = u.length; n < a; n++)
                            if (u[n]._details) Re(r, n);
                    });
                }
                Le(n);
            }
        }
    }
    function Ae(t, e, n, a, r) {
        for (var o = [], i = 0, l = r.length; i < l; i++) o.push(S(t, r[i], e));
        return o;
    }
    var Ie = [],
        o = Array.prototype,
        B = function (t, e) {
            if (!(this instanceof B)) return new B(t, e);
            function n(t) {
                var e, n, a, r;
                (t = t),
                    (a = w.settings),
                    (r = P.map(a, function (t, e) {
                        return t.nTable;
                    })),
                    (t = t
                        ? t.nTable && t.oApi
                            ? [t]
                            : t.nodeName && "table" === t.nodeName.toLowerCase()
                            ? -1 !== (e = P.inArray(t, r))
                                ? [a[e]]
                                : null
                            : t && "function" == typeof t.settings
                            ? t.settings().toArray()
                            : ("string" == typeof t
                                  ? (n = P(t))
                                  : t instanceof P && (n = t),
                              n
                                  ? n
                                        .map(function (t) {
                                            return -1 !==
                                                (e = P.inArray(this, r))
                                                ? a[e]
                                                : null;
                                        })
                                        .toArray()
                                  : void 0)
                        : []) && o.push.apply(o, t);
            }
            var o = [];
            if (Array.isArray(t))
                for (var a = 0, r = t.length; a < r; a++) n(t[a]);
            else n(t);
            (this.context = z(o)),
                e && P.merge(this, e),
                (this.selector = { rows: null, cols: null, opts: null }),
                B.extend(this, this, Ie);
        },
        Fe =
            ((w.Api = B),
            P.extend(B.prototype, {
                any: function () {
                    return 0 !== this.count();
                },
                concat: o.concat,
                context: [],
                count: function () {
                    return this.flatten().length;
                },
                each: function (t) {
                    for (var e = 0, n = this.length; e < n; e++)
                        t.call(this, this[e], e, this);
                    return this;
                },
                eq: function (t) {
                    var e = this.context;
                    return e.length > t ? new B(e[t], this[t]) : null;
                },
                filter: function (t) {
                    var e = [];
                    if (o.filter) e = o.filter.call(this, t, this);
                    else
                        for (var n = 0, a = this.length; n < a; n++)
                            t.call(this, this[n], n, this) && e.push(this[n]);
                    return new B(this.context, e);
                },
                flatten: function () {
                    var t = [];
                    return new B(
                        this.context,
                        t.concat.apply(t, this.toArray())
                    );
                },
                join: o.join,
                indexOf:
                    o.indexOf ||
                    function (t, e) {
                        for (var n = e || 0, a = this.length; n < a; n++)
                            if (this[n] === t) return n;
                        return -1;
                    },
                iterator: function (t, e, n, a) {
                    var r,
                        o,
                        i,
                        l,
                        s,
                        u,
                        c,
                        f,
                        d = [],
                        h = this.context,
                        p = this.selector;
                    for (
                        "string" == typeof t &&
                            ((a = n), (n = e), (e = t), (t = !1)),
                            o = 0,
                            i = h.length;
                        o < i;
                        o++
                    ) {
                        var g = new B(h[o]);
                        if ("table" === e)
                            (r = n.call(g, h[o], o)) !== H && d.push(r);
                        else if ("columns" === e || "rows" === e)
                            (r = n.call(g, h[o], this[o], o)) !== H &&
                                d.push(r);
                        else if (
                            "column" === e ||
                            "column-rows" === e ||
                            "row" === e ||
                            "cell" === e
                        )
                            for (
                                c = this[o],
                                    "column-rows" === e &&
                                        (u = Fe(h[o], p.opts)),
                                    l = 0,
                                    s = c.length;
                                l < s;
                                l++
                            )
                                (f = c[l]),
                                    (r =
                                        "cell" === e
                                            ? n.call(
                                                  g,
                                                  h[o],
                                                  f.row,
                                                  f.column,
                                                  o,
                                                  l
                                              )
                                            : n.call(g, h[o], f, o, l, u)) !==
                                        H && d.push(r);
                    }
                    return d.length || a
                        ? (((t = (a = new B(h, t ? d.concat.apply([], d) : d))
                              .selector).rows = p.rows),
                          (t.cols = p.cols),
                          (t.opts = p.opts),
                          a)
                        : this;
                },
                lastIndexOf:
                    o.lastIndexOf ||
                    function (t, e) {
                        return this.indexOf.apply(
                            this.toArray.reverse(),
                            arguments
                        );
                    },
                length: 0,
                map: function (t) {
                    var e = [];
                    if (o.map) e = o.map.call(this, t, this);
                    else
                        for (var n = 0, a = this.length; n < a; n++)
                            e.push(t.call(this, this[n], n));
                    return new B(this.context, e);
                },
                pluck: function (t) {
                    var e = w.util.get(t);
                    return this.map(function (t) {
                        return e(t);
                    });
                },
                pop: o.pop,
                push: o.push,
                reduce:
                    o.reduce ||
                    function (t, e) {
                        return et(this, t, e, 0, this.length, 1);
                    },
                reduceRight:
                    o.reduceRight ||
                    function (t, e) {
                        return et(this, t, e, this.length - 1, -1, -1);
                    },
                reverse: o.reverse,
                selector: null,
                shift: o.shift,
                slice: function () {
                    return new B(this.context, this);
                },
                sort: o.sort,
                splice: o.splice,
                toArray: function () {
                    return o.slice.call(this);
                },
                to$: function () {
                    return P(this);
                },
                toJQuery: function () {
                    return P(this);
                },
                unique: function () {
                    return new B(this.context, z(this));
                },
                unshift: o.unshift,
            }),
            (B.extend = function (t, e, n) {
                if (n.length && e && (e instanceof B || e.__dt_wrapper))
                    for (var a, r = 0, o = n.length; r < o; r++)
                        (e[(a = n[r]).name] =
                            "function" === a.type
                                ? (function (e, n, a) {
                                      return function () {
                                          var t = n.apply(e, arguments);
                                          return B.extend(t, t, a.methodExt), t;
                                      };
                                  })(t, a.val, a)
                                : "object" === a.type
                                ? {}
                                : a.val),
                            (e[a.name].__dt_wrapper = !0),
                            B.extend(t, e[a.name], a.propExt);
            }),
            (B.register = e =
                function (t, e) {
                    if (Array.isArray(t))
                        for (var n = 0, a = t.length; n < a; n++)
                            B.register(t[n], e);
                    else
                        for (
                            var r = t.split("."), o = Ie, i = 0, l = r.length;
                            i < l;
                            i++
                        ) {
                            var s,
                                u,
                                c = (function (t, e) {
                                    for (var n = 0, a = t.length; n < a; n++)
                                        if (t[n].name === e) return t[n];
                                    return null;
                                })(
                                    o,
                                    (u = (s = -1 !== r[i].indexOf("()"))
                                        ? r[i].replace("()", "")
                                        : r[i])
                                );
                            c ||
                                o.push(
                                    (c = {
                                        name: u,
                                        val: {},
                                        methodExt: [],
                                        propExt: [],
                                        type: "object",
                                    })
                                ),
                                i === l - 1
                                    ? ((c.val = e),
                                      (c.type =
                                          "function" == typeof e
                                              ? "function"
                                              : P.isPlainObject(e)
                                              ? "object"
                                              : "other"))
                                    : (o = s ? c.methodExt : c.propExt);
                        }
                }),
            (B.registerPlural = t =
                function (t, e, n) {
                    B.register(t, n),
                        B.register(e, function () {
                            var t = n.apply(this, arguments);
                            return t === this
                                ? this
                                : t instanceof B
                                ? t.length
                                    ? Array.isArray(t[0])
                                        ? new B(t.context, t[0])
                                        : t[0]
                                    : H
                                : t;
                        });
                }),
            e("tables()", function (t) {
                return t !== H && null !== t
                    ? new B(ye(t, this.context))
                    : this;
            }),
            e("table()", function (t) {
                var t = this.tables(t),
                    e = t.context;
                return e.length ? new B(e[0]) : t;
            }),
            t("tables().nodes()", "table().node()", function () {
                return this.iterator(
                    "table",
                    function (t) {
                        return t.nTable;
                    },
                    1
                );
            }),
            t("tables().body()", "table().body()", function () {
                return this.iterator(
                    "table",
                    function (t) {
                        return t.nTBody;
                    },
                    1
                );
            }),
            t("tables().header()", "table().header()", function () {
                return this.iterator(
                    "table",
                    function (t) {
                        return t.nTHead;
                    },
                    1
                );
            }),
            t("tables().footer()", "table().footer()", function () {
                return this.iterator(
                    "table",
                    function (t) {
                        return t.nTFoot;
                    },
                    1
                );
            }),
            t("tables().containers()", "table().container()", function () {
                return this.iterator(
                    "table",
                    function (t) {
                        return t.nTableWrapper;
                    },
                    1
                );
            }),
            e("draw()", function (e) {
                return this.iterator("table", function (t) {
                    "page" === e
                        ? v(t)
                        : u(
                              t,
                              !1 ===
                                  (e =
                                      "string" == typeof e
                                          ? "full-hold" !== e
                                          : e)
                          );
                });
            }),
            e("page()", function (e) {
                return e === H
                    ? this.page.info().page
                    : this.iterator("table", function (t) {
                          Yt(t, e);
                      });
            }),
            e("page.info()", function (t) {
                var e, n, a, r, o;
                return 0 === this.context.length
                    ? H
                    : ((n = (e = this.context[0])._iDisplayStart),
                      (a = e.oFeatures.bPaginate ? e._iDisplayLength : -1),
                      (r = e.fnRecordsDisplay()),
                      {
                          page: (o = -1 === a) ? 0 : Math.floor(n / a),
                          pages: o ? 1 : Math.ceil(r / a),
                          start: n,
                          end: e.fnDisplayEnd(),
                          length: a,
                          recordsTotal: e.fnRecordsTotal(),
                          recordsDisplay: r,
                          serverSide: "ssp" === E(e),
                      });
            }),
            e("page.len()", function (e) {
                return e === H
                    ? 0 !== this.context.length
                        ? this.context[0]._iDisplayLength
                        : H
                    : this.iterator("table", function (t) {
                          $t(t, e);
                      });
            }),
            e("ajax.json()", function () {
                var t = this.context;
                if (0 < t.length) return t[0].json;
            }),
            e("ajax.params()", function () {
                var t = this.context;
                if (0 < t.length) return t[0].oAjaxData;
            }),
            e("ajax.reload()", function (e, n) {
                return this.iterator("table", function (t) {
                    De(t, !1 === n, e);
                });
            }),
            e("ajax.url()", function (e) {
                var t = this.context;
                return e === H
                    ? 0 === t.length
                        ? H
                        : (t = t[0]).ajax
                        ? P.isPlainObject(t.ajax)
                            ? t.ajax.url
                            : t.ajax
                        : t.sAjaxSource
                    : this.iterator("table", function (t) {
                          P.isPlainObject(t.ajax)
                              ? (t.ajax.url = e)
                              : (t.ajax = e);
                      });
            }),
            e("ajax.url().load()", function (e, n) {
                return this.iterator("table", function (t) {
                    De(t, !1 === n, e);
                });
            }),
            function (t, e) {
                var n,
                    a = [],
                    r = t.aiDisplay,
                    o = t.aiDisplayMaster,
                    i = e.search,
                    l = e.order,
                    e = e.page;
                if ("ssp" == E(t)) return "removed" === i ? [] : f(0, o.length);
                if ("current" == e)
                    for (u = t._iDisplayStart, c = t.fnDisplayEnd(); u < c; u++)
                        a.push(r[u]);
                else if ("current" == l || "applied" == l) {
                    if ("none" == i) a = o.slice();
                    else if ("applied" == i) a = r.slice();
                    else if ("removed" == i) {
                        for (var s = {}, u = 0, c = r.length; u < c; u++)
                            s[r[u]] = null;
                        a = P.map(o, function (t) {
                            return s.hasOwnProperty(t) ? null : t;
                        });
                    }
                } else if ("index" == l || "original" == l)
                    for (u = 0, c = t.aoData.length; u < c; u++)
                        ("none" == i ||
                            (-1 === (n = P.inArray(u, r)) && "removed" == i) ||
                            (0 <= n && "applied" == i)) &&
                            a.push(u);
                return a;
            }),
        Le =
            (e("rows()", function (e, n) {
                e === H ? (e = "") : P.isPlainObject(e) && ((n = e), (e = "")),
                    (n = we(n));
                var t = this.iterator(
                    "table",
                    function (t) {
                        return _e(
                            "row",
                            e,
                            function (n) {
                                var t = d(n),
                                    a = r.aoData;
                                if (null !== t && !o) return [t];
                                if (
                                    ((i = i || Fe(r, o)),
                                    null !== t && -1 !== P.inArray(t, i))
                                )
                                    return [t];
                                if (null === n || n === H || "" === n) return i;
                                if ("function" == typeof n)
                                    return P.map(i, function (t) {
                                        var e = a[t];
                                        return n(t, e._aData, e.nTr) ? t : null;
                                    });
                                if (n.nodeName)
                                    return (
                                        (t = n._DT_RowIndex),
                                        (e = n._DT_CellIndex),
                                        t !== H
                                            ? a[t] && a[t].nTr === n
                                                ? [t]
                                                : []
                                            : e
                                            ? a[e.row] &&
                                              a[e.row].nTr === n.parentNode
                                                ? [e.row]
                                                : []
                                            : (t =
                                                  P(n).closest(
                                                      "*[data-dt-row]"
                                                  )).length
                                            ? [t.data("dt-row")]
                                            : []
                                    );
                                if (
                                    "string" == typeof n &&
                                    "#" === n.charAt(0)
                                ) {
                                    var e = r.aIds[n.replace(/^#/, "")];
                                    if (e !== H) return [e.idx];
                                }
                                t = _(m(r.aoData, i, "nTr"));
                                return P(t)
                                    .filter(n)
                                    .map(function () {
                                        return this._DT_RowIndex;
                                    })
                                    .toArray();
                            },
                            (r = t),
                            (o = n)
                        );
                        var r, o, i;
                    },
                    1
                );
                return (t.selector.rows = e), (t.selector.opts = n), t;
            }),
            e("rows().nodes()", function () {
                return this.iterator(
                    "row",
                    function (t, e) {
                        return t.aoData[e].nTr || H;
                    },
                    1
                );
            }),
            e("rows().data()", function () {
                return this.iterator(
                    !0,
                    "rows",
                    function (t, e) {
                        return m(t.aoData, e, "_aData");
                    },
                    1
                );
            }),
            t("rows().cache()", "row().cache()", function (n) {
                return this.iterator(
                    "row",
                    function (t, e) {
                        t = t.aoData[e];
                        return "search" === n ? t._aFilterData : t._aSortData;
                    },
                    1
                );
            }),
            t("rows().invalidate()", "row().invalidate()", function (n) {
                return this.iterator("row", function (t, e) {
                    bt(t, e, n);
                });
            }),
            t("rows().indexes()", "row().index()", function () {
                return this.iterator(
                    "row",
                    function (t, e) {
                        return e;
                    },
                    1
                );
            }),
            t("rows().ids()", "row().id()", function (t) {
                for (
                    var e = [], n = this.context, a = 0, r = n.length;
                    a < r;
                    a++
                )
                    for (var o = 0, i = this[a].length; o < i; o++) {
                        var l = n[a].rowIdFn(n[a].aoData[this[a][o]]._aData);
                        e.push((!0 === t ? "#" : "") + l);
                    }
                return new B(n, e);
            }),
            t("rows().remove()", "row().remove()", function () {
                var f = this;
                return (
                    this.iterator("row", function (t, e, n) {
                        var a,
                            r,
                            o,
                            i,
                            l,
                            s,
                            u = t.aoData,
                            c = u[e];
                        for (u.splice(e, 1), a = 0, r = u.length; a < r; a++)
                            if (
                                ((s = (l = u[a]).anCells),
                                null !== l.nTr && (l.nTr._DT_RowIndex = a),
                                null !== s)
                            )
                                for (o = 0, i = s.length; o < i; o++)
                                    s[o]._DT_CellIndex.row = a;
                        gt(t.aiDisplayMaster, e),
                            gt(t.aiDisplay, e),
                            gt(f[n], e, !1),
                            0 < t._iRecordsDisplay && t._iRecordsDisplay--,
                            Se(t);
                        n = t.rowIdFn(c._aData);
                        n !== H && delete t.aIds[n];
                    }),
                    this.iterator("table", function (t) {
                        for (var e = 0, n = t.aoData.length; e < n; e++)
                            t.aoData[e].idx = e;
                    }),
                    this
                );
            }),
            e("rows.add()", function (o) {
                var t = this.iterator(
                        "table",
                        function (t) {
                            for (var e, n = [], a = 0, r = o.length; a < r; a++)
                                (e = o[a]).nodeName &&
                                "TR" === e.nodeName.toUpperCase()
                                    ? n.push(ut(t, e)[0])
                                    : n.push(x(t, e));
                            return n;
                        },
                        1
                    ),
                    e = this.rows(-1);
                return e.pop(), P.merge(e, t), e;
            }),
            e("row()", function (t, e) {
                return Ce(this.rows(t, e));
            }),
            e("row().data()", function (t) {
                var e,
                    n = this.context;
                return t === H
                    ? n.length && this.length
                        ? n[0].aoData[this[0]]._aData
                        : H
                    : (((e = n[0].aoData[this[0]])._aData = t),
                      Array.isArray(t) &&
                          e.nTr &&
                          e.nTr.id &&
                          b(n[0].rowId)(t, e.nTr.id),
                      bt(n[0], this[0], "data"),
                      this);
            }),
            e("row().node()", function () {
                var t = this.context;
                return (
                    (t.length && this.length && t[0].aoData[this[0]].nTr) ||
                    null
                );
            }),
            e("row.add()", function (e) {
                e instanceof P && e.length && (e = e[0]);
                var t = this.iterator("table", function (t) {
                    return e.nodeName && "TR" === e.nodeName.toUpperCase()
                        ? ut(t, e)[0]
                        : x(t, e);
                });
                return this.row(t[0]);
            }),
            P(y).on("plugin-init.dt", function (t, e) {
                var n = new B(e),
                    a = "on-plugin-init",
                    r = "stateSaveParams." + a,
                    o = "destroy. " + a,
                    a =
                        (n.on(r, function (t, e, n) {
                            for (
                                var a = e.rowIdFn, r = e.aoData, o = [], i = 0;
                                i < r.length;
                                i++
                            )
                                r[i]._detailsShow &&
                                    o.push("#" + a(r[i]._aData));
                            n.childRows = o;
                        }),
                        n.on(o, function () {
                            n.off(r + " " + o);
                        }),
                        n.state.loaded());
                a &&
                    a.childRows &&
                    n
                        .rows(
                            P.map(a.childRows, function (t) {
                                return t.replace(/:/g, "\\:");
                            })
                        )
                        .every(function () {
                            R(e, null, "requestChild", [this]);
                        });
            }),
            w.util.throttle(function (t) {
                de(t[0]);
            }, 500)),
        Re = function (t, e) {
            var n = t.context;
            n.length &&
                (e = n[0].aoData[e !== H ? e : t[0]]) &&
                e._details &&
                (e._details.remove(),
                (e._detailsShow = H),
                (e._details = H),
                P(e.nTr).removeClass("dt-hasChild"),
                Le(n));
        },
        Pe = "row().child",
        je = Pe + "()",
        He =
            (e(je, function (t, e) {
                var n = this.context;
                return t === H
                    ? n.length && this.length
                        ? n[0].aoData[this[0]]._details
                        : H
                    : (!0 === t
                          ? this.child.show()
                          : !1 === t
                          ? Re(this)
                          : n.length &&
                            this.length &&
                            Te(n[0], n[0].aoData[this[0]], t, e),
                      this);
            }),
            e([Pe + ".show()", je + ".show()"], function (t) {
                return xe(this, !0), this;
            }),
            e([Pe + ".hide()", je + ".hide()"], function () {
                return xe(this, !1), this;
            }),
            e([Pe + ".remove()", je + ".remove()"], function () {
                return Re(this), this;
            }),
            e(Pe + ".isShown()", function () {
                var t = this.context;
                return (
                    (t.length &&
                        this.length &&
                        t[0].aoData[this[0]]._detailsShow) ||
                    !1
                );
            }),
            /^([^:]+):(name|visIdx|visible)$/),
        Ne =
            (e("columns()", function (n, a) {
                n === H ? (n = "") : P.isPlainObject(n) && ((a = n), (n = "")),
                    (a = we(a));
                var t = this.iterator(
                    "table",
                    function (t) {
                        return (
                            (e = n),
                            (l = a),
                            (s = (i = t).aoColumns),
                            (u = N(s, "sName")),
                            (c = N(s, "nTh")),
                            _e(
                                "column",
                                e,
                                function (n) {
                                    var a,
                                        t = d(n);
                                    if ("" === n) return f(s.length);
                                    if (null !== t)
                                        return [0 <= t ? t : s.length + t];
                                    if ("function" == typeof n)
                                        return (
                                            (a = Fe(i, l)),
                                            P.map(s, function (t, e) {
                                                return n(
                                                    e,
                                                    Ae(i, e, 0, 0, a),
                                                    c[e]
                                                )
                                                    ? e
                                                    : null;
                                            })
                                        );
                                    var r =
                                        "string" == typeof n ? n.match(He) : "";
                                    if (r)
                                        switch (r[2]) {
                                            case "visIdx":
                                            case "visible":
                                                var e,
                                                    o = parseInt(r[1], 10);
                                                return o < 0
                                                    ? [
                                                          (e = P.map(
                                                              s,
                                                              function (t, e) {
                                                                  return t.bVisible
                                                                      ? e
                                                                      : null;
                                                              }
                                                          ))[e.length + o],
                                                      ]
                                                    : [rt(i, o)];
                                            case "name":
                                                return P.map(
                                                    u,
                                                    function (t, e) {
                                                        return t === r[1]
                                                            ? e
                                                            : null;
                                                    }
                                                );
                                            default:
                                                return [];
                                        }
                                    return n.nodeName && n._DT_CellIndex
                                        ? [n._DT_CellIndex.column]
                                        : (t = P(c)
                                              .filter(n)
                                              .map(function () {
                                                  return P.inArray(this, c);
                                              })
                                              .toArray()).length || !n.nodeName
                                        ? t
                                        : (t =
                                              P(n).closest("*[data-dt-column]"))
                                              .length
                                        ? [t.data("dt-column")]
                                        : [];
                                },
                                i,
                                l
                            )
                        );
                        var i, e, l, s, u, c;
                    },
                    1
                );
                return (t.selector.cols = n), (t.selector.opts = a), t;
            }),
            t("columns().header()", "column().header()", function (t, e) {
                return this.iterator(
                    "column",
                    function (t, e) {
                        return t.aoColumns[e].nTh;
                    },
                    1
                );
            }),
            t("columns().footer()", "column().footer()", function (t, e) {
                return this.iterator(
                    "column",
                    function (t, e) {
                        return t.aoColumns[e].nTf;
                    },
                    1
                );
            }),
            t("columns().data()", "column().data()", function () {
                return this.iterator("column-rows", Ae, 1);
            }),
            t("columns().dataSrc()", "column().dataSrc()", function () {
                return this.iterator(
                    "column",
                    function (t, e) {
                        return t.aoColumns[e].mData;
                    },
                    1
                );
            }),
            t("columns().cache()", "column().cache()", function (o) {
                return this.iterator(
                    "column-rows",
                    function (t, e, n, a, r) {
                        return m(
                            t.aoData,
                            r,
                            "search" === o ? "_aFilterData" : "_aSortData",
                            e
                        );
                    },
                    1
                );
            }),
            t("columns().nodes()", "column().nodes()", function () {
                return this.iterator(
                    "column-rows",
                    function (t, e, n, a, r) {
                        return m(t.aoData, r, "anCells", e);
                    },
                    1
                );
            }),
            t("columns().visible()", "column().visible()", function (f, n) {
                var e = this,
                    t = this.iterator("column", function (t, e) {
                        if (f === H) return t.aoColumns[e].bVisible;
                        var n,
                            a,
                            r = e,
                            e = f,
                            o = t.aoColumns,
                            i = o[r],
                            l = t.aoData;
                        if (e === H) i.bVisible;
                        else if (i.bVisible !== e) {
                            if (e)
                                for (
                                    var s = P.inArray(
                                            !0,
                                            N(o, "bVisible"),
                                            r + 1
                                        ),
                                        u = 0,
                                        c = l.length;
                                    u < c;
                                    u++
                                )
                                    (a = l[u].nTr),
                                        (n = l[u].anCells),
                                        a && a.insertBefore(n[r], n[s] || null);
                            else P(N(t.aoData, "anCells", r)).detach();
                            i.bVisible = e;
                        }
                    });
                return (
                    f !== H &&
                        this.iterator("table", function (t) {
                            Dt(t, t.aoHeader),
                                Dt(t, t.aoFooter),
                                t.aiDisplay.length ||
                                    P(t.nTBody)
                                        .find("td[colspan]")
                                        .attr("colspan", T(t)),
                                de(t),
                                e.iterator("column", function (t, e) {
                                    R(t, null, "column-visibility", [
                                        t,
                                        e,
                                        f,
                                        n,
                                    ]);
                                }),
                                (n !== H && !n) || e.columns.adjust();
                        }),
                    t
                );
            }),
            t("columns().indexes()", "column().index()", function (n) {
                return this.iterator(
                    "column",
                    function (t, e) {
                        return "visible" === n ? ot(t, e) : e;
                    },
                    1
                );
            }),
            e("columns.adjust()", function () {
                return this.iterator(
                    "table",
                    function (t) {
                        O(t);
                    },
                    1
                );
            }),
            e("column.index()", function (t, e) {
                var n;
                if (0 !== this.context.length)
                    return (
                        (n = this.context[0]),
                        "fromVisible" === t || "toData" === t
                            ? rt(n, e)
                            : "fromData" === t || "toVisible" === t
                            ? ot(n, e)
                            : void 0
                    );
            }),
            e("column()", function (t, e) {
                return Ce(this.columns(t, e));
            }),
            e("cells()", function (g, t, b) {
                var a, r, o, i, l, s, e;
                return (
                    P.isPlainObject(g) &&
                        (g.row === H
                            ? ((b = g), (g = null))
                            : ((b = t), (t = null))),
                    P.isPlainObject(t) && ((b = t), (t = null)),
                    null === t || t === H
                        ? this.iterator("table", function (t) {
                              return (
                                  (a = t),
                                  (t = g),
                                  (e = we(b)),
                                  (f = a.aoData),
                                  (d = Fe(a, e)),
                                  (n = _(m(f, d, "anCells"))),
                                  (h = P(Y([], n))),
                                  (p = a.aoColumns.length),
                                  _e(
                                      "cell",
                                      t,
                                      function (t) {
                                          var e,
                                              n = "function" == typeof t;
                                          if (null === t || t === H || n) {
                                              for (
                                                  o = [], i = 0, l = d.length;
                                                  i < l;
                                                  i++
                                              )
                                                  for (
                                                      r = d[i], s = 0;
                                                      s < p;
                                                      s++
                                                  )
                                                      (u = {
                                                          row: r,
                                                          column: s,
                                                      }),
                                                          (!n ||
                                                              ((c = f[r]),
                                                              t(
                                                                  u,
                                                                  S(a, r, s),
                                                                  c.anCells
                                                                      ? c
                                                                            .anCells[
                                                                            s
                                                                        ]
                                                                      : null
                                                              ))) &&
                                                              o.push(u);
                                              return o;
                                          }
                                          return P.isPlainObject(t)
                                              ? t.column !== H &&
                                                t.row !== H &&
                                                -1 !== P.inArray(t.row, d)
                                                  ? [t]
                                                  : []
                                              : (e = h
                                                    .filter(t)
                                                    .map(function (t, e) {
                                                        return {
                                                            row: e._DT_CellIndex
                                                                .row,
                                                            column: e
                                                                ._DT_CellIndex
                                                                .column,
                                                        };
                                                    })
                                                    .toArray()).length ||
                                                !t.nodeName
                                              ? e
                                              : (c =
                                                    P(t).closest(
                                                        "*[data-dt-row]"
                                                    )).length
                                              ? [
                                                    {
                                                        row: c.data("dt-row"),
                                                        column: c.data(
                                                            "dt-column"
                                                        ),
                                                    },
                                                ]
                                              : [];
                                      },
                                      a,
                                      e
                                  )
                              );
                              var a, e, r, o, i, l, s, u, c, f, d, n, h, p;
                          })
                        : ((e = b
                              ? {
                                    page: b.page,
                                    order: b.order,
                                    search: b.search,
                                }
                              : {}),
                          (a = this.columns(t, e)),
                          (r = this.rows(g, e)),
                          (e = this.iterator(
                              "table",
                              function (t, e) {
                                  var n = [];
                                  for (o = 0, i = r[e].length; o < i; o++)
                                      for (l = 0, s = a[e].length; l < s; l++)
                                          n.push({
                                              row: r[e][o],
                                              column: a[e][l],
                                          });
                                  return n;
                              },
                              1
                          )),
                          (e = b && b.selected ? this.cells(e, b) : e),
                          P.extend(e.selector, { cols: t, rows: g, opts: b }),
                          e)
                );
            }),
            t("cells().nodes()", "cell().node()", function () {
                return this.iterator(
                    "cell",
                    function (t, e, n) {
                        t = t.aoData[e];
                        return t && t.anCells ? t.anCells[n] : H;
                    },
                    1
                );
            }),
            e("cells().data()", function () {
                return this.iterator(
                    "cell",
                    function (t, e, n) {
                        return S(t, e, n);
                    },
                    1
                );
            }),
            t("cells().cache()", "cell().cache()", function (a) {
                return (
                    (a = "search" === a ? "_aFilterData" : "_aSortData"),
                    this.iterator(
                        "cell",
                        function (t, e, n) {
                            return t.aoData[e][a][n];
                        },
                        1
                    )
                );
            }),
            t("cells().render()", "cell().render()", function (a) {
                return this.iterator(
                    "cell",
                    function (t, e, n) {
                        return S(t, e, n, a);
                    },
                    1
                );
            }),
            t("cells().indexes()", "cell().index()", function () {
                return this.iterator(
                    "cell",
                    function (t, e, n) {
                        return { row: e, column: n, columnVisible: ot(t, n) };
                    },
                    1
                );
            }),
            t("cells().invalidate()", "cell().invalidate()", function (a) {
                return this.iterator("cell", function (t, e, n) {
                    bt(t, e, a, n);
                });
            }),
            e("cell()", function (t, e, n) {
                return Ce(this.cells(t, e, n));
            }),
            e("cell().data()", function (t) {
                var e = this.context,
                    n = this[0];
                return t === H
                    ? e.length && n.length
                        ? S(e[0], n[0].row, n[0].column)
                        : H
                    : (ct(e[0], n[0].row, n[0].column, t),
                      bt(e[0], n[0].row, "data", n[0].column),
                      this);
            }),
            e("order()", function (e, t) {
                var n = this.context;
                return e === H
                    ? 0 !== n.length
                        ? n[0].aaSorting
                        : H
                    : ("number" == typeof e
                          ? (e = [[e, t]])
                          : e.length &&
                            !Array.isArray(e[0]) &&
                            (e = Array.prototype.slice.call(arguments)),
                      this.iterator("table", function (t) {
                          t.aaSorting = e.slice();
                      }));
            }),
            e("order.listener()", function (e, n, a) {
                return this.iterator("table", function (t) {
                    ue(t, e, n, a);
                });
            }),
            e("order.fixed()", function (e) {
                var t;
                return e
                    ? this.iterator("table", function (t) {
                          t.aaSortingFixed = P.extend(!0, {}, e);
                      })
                    : ((t = (t = this.context).length
                          ? t[0].aaSortingFixed
                          : H),
                      Array.isArray(t) ? { pre: t } : t);
            }),
            e(["columns().order()", "column().order()"], function (a) {
                var r = this;
                return this.iterator("table", function (t, e) {
                    var n = [];
                    P.each(r[e], function (t, e) {
                        n.push([e, a]);
                    }),
                        (t.aaSorting = n);
                });
            }),
            e("search()", function (e, n, a, r) {
                var t = this.context;
                return e === H
                    ? 0 !== t.length
                        ? t[0].oPreviousSearch.sSearch
                        : H
                    : this.iterator("table", function (t) {
                          t.oFeatures.bFilter &&
                              Rt(
                                  t,
                                  P.extend({}, t.oPreviousSearch, {
                                      sSearch: e + "",
                                      bRegex: null !== n && n,
                                      bSmart: null === a || a,
                                      bCaseInsensitive: null === r || r,
                                  }),
                                  1
                              );
                      });
            }),
            t("columns().search()", "column().search()", function (a, r, o, i) {
                return this.iterator("column", function (t, e) {
                    var n = t.aoPreSearchCols;
                    if (a === H) return n[e].sSearch;
                    t.oFeatures.bFilter &&
                        (P.extend(n[e], {
                            sSearch: a + "",
                            bRegex: null !== r && r,
                            bSmart: null === o || o,
                            bCaseInsensitive: null === i || i,
                        }),
                        Rt(t, t.oPreviousSearch, 1));
                });
            }),
            e("state()", function () {
                return this.context.length ? this.context[0].oSavedState : null;
            }),
            e("state.clear()", function () {
                return this.iterator("table", function (t) {
                    t.fnStateSaveCallback.call(t.oInstance, t, {});
                });
            }),
            e("state.loaded()", function () {
                return this.context.length
                    ? this.context[0].oLoadedState
                    : null;
            }),
            e("state.save()", function () {
                return this.iterator("table", function (t) {
                    de(t);
                });
            }),
            (w.use = function (t, e) {
                "lib" === e || t.fn
                    ? (P = t)
                    : "win" == e || t.document
                    ? (y = (j = t).document)
                    : ("datetime" !== e && "DateTime" !== t.type) ||
                      (w.DateTime = t);
            }),
            (w.factory = function (t, e) {
                var n = !1;
                return (
                    t && t.document && (y = (j = t).document),
                    e && e.fn && e.fn.jquery && ((P = e), (n = !0)),
                    n
                );
            }),
            (w.versionCheck = w.fnVersionCheck =
                function (t) {
                    for (
                        var e,
                            n,
                            a = w.version.split("."),
                            r = t.split("."),
                            o = 0,
                            i = r.length;
                        o < i;
                        o++
                    )
                        if (
                            (e = parseInt(a[o], 10) || 0) !==
                            (n = parseInt(r[o], 10) || 0)
                        )
                            return n < e;
                    return !0;
                }),
            (w.isDataTable = w.fnIsDataTable =
                function (t) {
                    var r = P(t).get(0),
                        o = !1;
                    return (
                        t instanceof w.Api ||
                        (P.each(w.settings, function (t, e) {
                            var n = e.nScrollHead
                                    ? P("table", e.nScrollHead)[0]
                                    : null,
                                a = e.nScrollFoot
                                    ? P("table", e.nScrollFoot)[0]
                                    : null;
                            (e.nTable !== r && n !== r && a !== r) || (o = !0);
                        }),
                        o)
                    );
                }),
            (w.tables = w.fnTables =
                function (e) {
                    var t = !1,
                        n =
                            (P.isPlainObject(e) &&
                                ((t = e.api), (e = e.visible)),
                            P.map(w.settings, function (t) {
                                if (!e || P(t.nTable).is(":visible"))
                                    return t.nTable;
                            }));
                    return t ? new B(n) : n;
                }),
            (w.camelToHungarian = C),
            e("$()", function (t, e) {
                (e = this.rows(e).nodes()), (e = P(e));
                return P([].concat(e.filter(t).toArray(), e.find(t).toArray()));
            }),
            P.each(["on", "one", "off"], function (t, n) {
                e(n + "()", function () {
                    var t = Array.prototype.slice.call(arguments),
                        e =
                            ((t[0] = P.map(t[0].split(/\s/), function (t) {
                                return t.match(/\.dt\b/) ? t : t + ".dt";
                            }).join(" ")),
                            P(this.tables().nodes()));
                    return e[n].apply(e, t), this;
                });
            }),
            e("clear()", function () {
                return this.iterator("table", function (t) {
                    pt(t);
                });
            }),
            e("settings()", function () {
                return new B(this.context, this.context);
            }),
            e("init()", function () {
                var t = this.context;
                return t.length ? t[0].oInit : null;
            }),
            e("data()", function () {
                return this.iterator("table", function (t) {
                    return N(t.aoData, "_aData");
                }).flatten();
            }),
            e("destroy()", function (c) {
                return (
                    (c = c || !1),
                    this.iterator("table", function (e) {
                        var n,
                            t = e.oClasses,
                            a = e.nTable,
                            r = e.nTBody,
                            o = e.nTHead,
                            i = e.nTFoot,
                            l = P(a),
                            r = P(r),
                            s = P(e.nTableWrapper),
                            u = P.map(e.aoData, function (t) {
                                return t.nTr;
                            }),
                            i =
                                ((e.bDestroying = !0),
                                R(e, "aoDestroyCallback", "destroy", [e]),
                                c || new B(e).columns().visible(!0),
                                s.off(".DT").find(":not(tbody *)").off(".DT"),
                                P(j).off(".DT-" + e.sInstance),
                                a != o.parentNode &&
                                    (l.children("thead").detach(), l.append(o)),
                                i &&
                                    a != i.parentNode &&
                                    (l.children("tfoot").detach(), l.append(i)),
                                (e.aaSorting = []),
                                (e.aaSortingFixed = []),
                                ce(e),
                                P(u).removeClass(e.asStripeClasses.join(" ")),
                                P("th, td", o).removeClass(
                                    t.sSortable +
                                        " " +
                                        t.sSortableAsc +
                                        " " +
                                        t.sSortableDesc +
                                        " " +
                                        t.sSortableNone
                                ),
                                r.children().detach(),
                                r.append(u),
                                e.nTableWrapper.parentNode),
                            o = c ? "remove" : "detach",
                            u =
                                (l[o](),
                                s[o](),
                                !c &&
                                    i &&
                                    (i.insertBefore(a, e.nTableReinsertBefore),
                                    l
                                        .css("width", e.sDestroyWidth)
                                        .removeClass(t.sTable),
                                    (n = e.asDestroyStripes.length)) &&
                                    r.children().each(function (t) {
                                        P(this).addClass(
                                            e.asDestroyStripes[t % n]
                                        );
                                    }),
                                P.inArray(e, w.settings));
                        -1 !== u && w.settings.splice(u, 1);
                    })
                );
            }),
            P.each(["column", "row", "cell"], function (t, s) {
                e(s + "s().every()", function (o) {
                    var i = this.selector.opts,
                        l = this;
                    return this.iterator(s, function (t, e, n, a, r) {
                        o.call(
                            l[s](e, "cell" === s ? n : i, "cell" === s ? i : H),
                            e,
                            n,
                            a,
                            r
                        );
                    });
                });
            }),
            e("i18n()", function (t, e, n) {
                var a = this.context[0],
                    t = A(t)(a.oLanguage);
                return (
                    t === H && (t = e),
                    "string" ==
                    typeof (t =
                        n !== H && P.isPlainObject(t)
                            ? t[n] !== H
                                ? t[n]
                                : t._
                            : t)
                        ? t.replace("%d", n)
                        : t
                );
            }),
            (w.version = "1.13.5"),
            (w.settings = []),
            (w.models = {}),
            (w.models.oSearch = {
                bCaseInsensitive: !0,
                sSearch: "",
                bRegex: !1,
                bSmart: !0,
                return: !1,
            }),
            (w.models.oRow = {
                nTr: null,
                anCells: null,
                _aData: [],
                _aSortData: null,
                _aFilterData: null,
                _sFilterRow: null,
                _sRowStripe: "",
                src: null,
                idx: -1,
            }),
            (w.models.oColumn = {
                idx: null,
                aDataSort: null,
                asSorting: null,
                bSearchable: null,
                bSortable: null,
                bVisible: null,
                _sManualType: null,
                _bAttrSrc: !1,
                fnCreatedCell: null,
                fnGetData: null,
                fnSetData: null,
                mData: null,
                mRender: null,
                nTh: null,
                nTf: null,
                sClass: null,
                sContentPadding: null,
                sDefaultContent: null,
                sName: null,
                sSortDataType: "std",
                sSortingClass: null,
                sSortingClassJUI: null,
                sTitle: null,
                sType: null,
                sWidth: null,
                sWidthOrig: null,
            }),
            (w.defaults = {
                aaData: null,
                aaSorting: [[0, "asc"]],
                aaSortingFixed: [],
                ajax: null,
                aLengthMenu: [10, 25, 50, 100],
                aoColumns: null,
                aoColumnDefs: null,
                aoSearchCols: [],
                asStripeClasses: null,
                bAutoWidth: !0,
                bDeferRender: !1,
                bDestroy: !1,
                bFilter: !0,
                bInfo: !0,
                bLengthChange: !0,
                bPaginate: !0,
                bProcessing: !1,
                bRetrieve: !1,
                bScrollCollapse: !1,
                bServerSide: !1,
                bSort: !0,
                bSortMulti: !0,
                bSortCellsTop: !1,
                bSortClasses: !0,
                bStateSave: !1,
                fnCreatedRow: null,
                fnDrawCallback: null,
                fnFooterCallback: null,
                fnFormatNumber: function (t) {
                    return t
                        .toString()
                        .replace(
                            /\B(?=(\d{3})+(?!\d))/g,
                            this.oLanguage.sThousands
                        );
                },
                fnHeaderCallback: null,
                fnInfoCallback: null,
                fnInitComplete: null,
                fnPreDrawCallback: null,
                fnRowCallback: null,
                fnServerData: null,
                fnServerParams: null,
                fnStateLoadCallback: function (t) {
                    try {
                        return JSON.parse(
                            (-1 === t.iStateDuration
                                ? sessionStorage
                                : localStorage
                            ).getItem(
                                "DataTables_" +
                                    t.sInstance +
                                    "_" +
                                    location.pathname
                            )
                        );
                    } catch (t) {
                        return {};
                    }
                },
                fnStateLoadParams: null,
                fnStateLoaded: null,
                fnStateSaveCallback: function (t, e) {
                    try {
                        (-1 === t.iStateDuration
                            ? sessionStorage
                            : localStorage
                        ).setItem(
                            "DataTables_" +
                                t.sInstance +
                                "_" +
                                location.pathname,
                            JSON.stringify(e)
                        );
                    } catch (t) {}
                },
                fnStateSaveParams: null,
                iStateDuration: 7200,
                iDeferLoading: null,
                iDisplayLength: 10,
                iDisplayStart: 0,
                iTabIndex: 0,
                oClasses: {},
                oLanguage: {
                    oAria: {
                        sSortAscending: ": activate to sort column ascending",
                        sSortDescending: ": activate to sort column descending",
                    },
                    oPaginate: {
                        sFirst: "First",
                        sLast: "Last",
                        sNext: "Next",
                        sPrevious: "Previous",
                    },
                    sEmptyTable: "No data available in table",
                    sInfo: "Showing _START_ to _END_ of _TOTAL_ entries",
                    sInfoEmpty: "Showing 0 to 0 of 0 entries",
                    sInfoFiltered: "(filtered from _MAX_ total entries)",
                    sInfoPostFix: "",
                    sDecimal: "",
                    sThousands: ",",
                    sLengthMenu: "Show _MENU_ entries",
                    sLoadingRecords: "Loading...",
                    sProcessing: "",
                    sSearch: "Search:",
                    sSearchPlaceholder: "",
                    sUrl: "",
                    sZeroRecords: "No matching records found",
                },
                oSearch: P.extend({}, w.models.oSearch),
                sAjaxDataProp: "data",
                sAjaxSource: null,
                sDom: "lfrtip",
                searchDelay: null,
                sPaginationType: "simple_numbers",
                sScrollX: "",
                sScrollXInner: "",
                sScrollY: "",
                sServerMethod: "GET",
                renderer: null,
                rowId: "DT_RowId",
            }),
            i(w.defaults),
            (w.defaults.column = {
                aDataSort: null,
                iDataSort: -1,
                asSorting: ["asc", "desc"],
                bSearchable: !0,
                bSortable: !0,
                bVisible: !0,
                fnCreatedCell: null,
                mData: null,
                mRender: null,
                sCellType: "td",
                sClass: "",
                sContentPadding: "",
                sDefaultContent: null,
                sName: "",
                sSortDataType: "std",
                sTitle: null,
                sType: null,
                sWidth: null,
            }),
            i(w.defaults.column),
            (w.models.oSettings = {
                oFeatures: {
                    bAutoWidth: null,
                    bDeferRender: null,
                    bFilter: null,
                    bInfo: null,
                    bLengthChange: null,
                    bPaginate: null,
                    bProcessing: null,
                    bServerSide: null,
                    bSort: null,
                    bSortMulti: null,
                    bSortClasses: null,
                    bStateSave: null,
                },
                oScroll: {
                    bCollapse: null,
                    iBarWidth: 0,
                    sX: null,
                    sXInner: null,
                    sY: null,
                },
                oLanguage: { fnInfoCallback: null },
                oBrowser: {
                    bScrollOversize: !1,
                    bScrollbarLeft: !1,
                    bBounding: !1,
                    barWidth: 0,
                },
                ajax: null,
                aanFeatures: [],
                aoData: [],
                aiDisplay: [],
                aiDisplayMaster: [],
                aIds: {},
                aoColumns: [],
                aoHeader: [],
                aoFooter: [],
                oPreviousSearch: {},
                aoPreSearchCols: [],
                aaSorting: null,
                aaSortingFixed: [],
                asStripeClasses: null,
                asDestroyStripes: [],
                sDestroyWidth: 0,
                aoRowCallback: [],
                aoHeaderCallback: [],
                aoFooterCallback: [],
                aoDrawCallback: [],
                aoRowCreatedCallback: [],
                aoPreDrawCallback: [],
                aoInitComplete: [],
                aoStateSaveParams: [],
                aoStateLoadParams: [],
                aoStateLoaded: [],
                sTableId: "",
                nTable: null,
                nTHead: null,
                nTFoot: null,
                nTBody: null,
                nTableWrapper: null,
                bDeferLoading: !1,
                bInitialised: !1,
                aoOpenRows: [],
                sDom: null,
                searchDelay: null,
                sPaginationType: "two_button",
                iStateDuration: 0,
                aoStateSave: [],
                aoStateLoad: [],
                oSavedState: null,
                oLoadedState: null,
                sAjaxSource: null,
                sAjaxDataProp: null,
                jqXHR: null,
                json: H,
                oAjaxData: H,
                fnServerData: null,
                aoServerParams: [],
                sServerMethod: null,
                fnFormatNumber: null,
                aLengthMenu: null,
                iDraw: 0,
                bDrawing: !1,
                iDrawError: -1,
                _iDisplayLength: 10,
                _iDisplayStart: 0,
                _iRecordsTotal: 0,
                _iRecordsDisplay: 0,
                oClasses: {},
                bFiltered: !1,
                bSorted: !1,
                bSortCellsTop: null,
                oInit: null,
                aoDestroyCallback: [],
                fnRecordsTotal: function () {
                    return "ssp" == E(this)
                        ? +this._iRecordsTotal
                        : this.aiDisplayMaster.length;
                },
                fnRecordsDisplay: function () {
                    return "ssp" == E(this)
                        ? +this._iRecordsDisplay
                        : this.aiDisplay.length;
                },
                fnDisplayEnd: function () {
                    var t = this._iDisplayLength,
                        e = this._iDisplayStart,
                        n = e + t,
                        a = this.aiDisplay.length,
                        r = this.oFeatures,
                        o = r.bPaginate;
                    return r.bServerSide
                        ? !1 === o || -1 === t
                            ? e + a
                            : Math.min(e + t, this._iRecordsDisplay)
                        : !o || a < n || -1 === t
                        ? a
                        : n;
                },
                oInstance: null,
                sInstance: null,
                iTabIndex: 0,
                nScrollHead: null,
                nScrollFoot: null,
                aLastSort: [],
                oPlugins: {},
                rowIdFn: null,
                rowId: null,
            }),
            (w.ext = p =
                {
                    buttons: {},
                    classes: {},
                    builder:
                        "bm/dt-1.13.5/b-2.4.1/b-colvis-2.4.1/fh-3.4.0/r-2.5.0/sc-2.2.0",
                    errMode: "alert",
                    feature: [],
                    search: [],
                    selector: { cell: [], column: [], row: [] },
                    internal: {},
                    legacy: { ajax: null },
                    pager: {},
                    renderer: { pageButton: {}, header: {} },
                    order: {},
                    type: { detect: [], search: {}, order: {} },
                    _unique: 0,
                    fnVersionCheck: w.fnVersionCheck,
                    iApiIndex: 0,
                    oJUIClasses: {},
                    sVersion: w.version,
                }),
            P.extend(p, {
                afnFiltering: p.search,
                aTypes: p.type.detect,
                ofnSearch: p.type.search,
                oSort: p.type.order,
                afnSortData: p.order,
                aoFeatures: p.feature,
                oApi: p.internal,
                oStdClasses: p.classes,
                oPagination: p.pager,
            }),
            P.extend(w.ext.classes, {
                sTable: "dataTable",
                sNoFooter: "no-footer",
                sPageButton: "paginate_button",
                sPageButtonActive: "current",
                sPageButtonDisabled: "disabled",
                sStripeOdd: "odd",
                sStripeEven: "even",
                sRowEmpty: "dataTables_empty",
                sWrapper: "dataTables_wrapper",
                sFilter: "dataTables_filter",
                sInfo: "dataTables_info",
                sPaging: "dataTables_paginate paging_",
                sLength: "dataTables_length",
                sProcessing: "dataTables_processing",
                sSortAsc: "sorting_asc",
                sSortDesc: "sorting_desc",
                sSortable: "sorting",
                sSortableAsc: "sorting_desc_disabled",
                sSortableDesc: "sorting_asc_disabled",
                sSortableNone: "sorting_disabled",
                sSortColumn: "sorting_",
                sFilterInput: "",
                sLengthSelect: "",
                sScrollWrapper: "dataTables_scroll",
                sScrollHead: "dataTables_scrollHead",
                sScrollHeadInner: "dataTables_scrollHeadInner",
                sScrollBody: "dataTables_scrollBody",
                sScrollFoot: "dataTables_scrollFoot",
                sScrollFootInner: "dataTables_scrollFootInner",
                sHeaderTH: "",
                sFooterTH: "",
                sSortJUIAsc: "",
                sSortJUIDesc: "",
                sSortJUI: "",
                sSortJUIAscAllowed: "",
                sSortJUIDescAllowed: "",
                sSortJUIWrapper: "",
                sSortIcon: "",
                sJUIHeader: "",
                sJUIFooter: "",
            }),
            w.ext.pager);
    function Oe(t, e) {
        var n = [],
            a = Ne.numbers_length,
            r = Math.floor(a / 2);
        return (
            e <= a
                ? (n = f(0, e))
                : t <= r
                ? ((n = f(0, a - 2)).push("ellipsis"), n.push(e - 1))
                : ((e - 1 - r <= t
                      ? (n = f(e - (a - 2), e))
                      : ((n = f(t - r + 2, t + r - 1)).push("ellipsis"),
                        n.push(e - 1),
                        n)
                  ).splice(0, 0, "ellipsis"),
                  n.splice(0, 0, 0)),
            (n.DT_el = "span"),
            n
        );
    }
    P.extend(Ne, {
        simple: function (t, e) {
            return ["previous", "next"];
        },
        full: function (t, e) {
            return ["first", "previous", "next", "last"];
        },
        numbers: function (t, e) {
            return [Oe(t, e)];
        },
        simple_numbers: function (t, e) {
            return ["previous", Oe(t, e), "next"];
        },
        full_numbers: function (t, e) {
            return ["first", "previous", Oe(t, e), "next", "last"];
        },
        first_last_numbers: function (t, e) {
            return ["first", Oe(t, e), "last"];
        },
        _numbers: Oe,
        numbers_length: 7,
    }),
        P.extend(!0, w.ext.renderer, {
            pageButton: {
                _: function (c, t, f, e, d, h) {
                    function p(t, e) {
                        for (
                            var n,
                                a,
                                r,
                                o = m.sPageButtonDisabled,
                                i = function (t) {
                                    Yt(c, t.data.action, !0);
                                },
                                l = 0,
                                s = e.length;
                            l < s;
                            l++
                        )
                            if (((n = e[l]), Array.isArray(n))) {
                                var u = P(
                                    "<" + (n.DT_el || "div") + "/>"
                                ).appendTo(t);
                                p(u, n);
                            } else {
                                switch (
                                    ((g = null), (b = n), (a = c.iTabIndex), n)
                                ) {
                                    case "ellipsis":
                                        t.append(
                                            '<span class="ellipsis">&#x2026;</span>'
                                        );
                                        break;
                                    case "first":
                                        (g = S.sFirst),
                                            0 === d &&
                                                ((a = -1), (b += " " + o));
                                        break;
                                    case "previous":
                                        (g = S.sPrevious),
                                            0 === d &&
                                                ((a = -1), (b += " " + o));
                                        break;
                                    case "next":
                                        (g = S.sNext),
                                            (0 !== h && d !== h - 1) ||
                                                ((a = -1), (b += " " + o));
                                        break;
                                    case "last":
                                        (g = S.sLast),
                                            (0 !== h && d !== h - 1) ||
                                                ((a = -1), (b += " " + o));
                                        break;
                                    default:
                                        (g = c.fnFormatNumber(n + 1)),
                                            (b =
                                                d === n
                                                    ? m.sPageButtonActive
                                                    : "");
                                }
                                null !== g &&
                                    ((u = c.oInit.pagingTag || "a"),
                                    (r = -1 !== b.indexOf(o)),
                                    me(
                                        P("<" + u + ">", {
                                            class: m.sPageButton + " " + b,
                                            "aria-controls": c.sTableId,
                                            "aria-disabled": r ? "true" : null,
                                            "aria-label": v[n],
                                            role: "link",
                                            "aria-current":
                                                b === m.sPageButtonActive
                                                    ? "page"
                                                    : null,
                                            "data-dt-idx": n,
                                            tabindex: a,
                                            id:
                                                0 === f && "string" == typeof n
                                                    ? c.sTableId + "_" + n
                                                    : null,
                                        })
                                            .html(g)
                                            .appendTo(t),
                                        { action: n },
                                        i
                                    ));
                            }
                    }
                    var g,
                        b,
                        n,
                        m = c.oClasses,
                        S = c.oLanguage.oPaginate,
                        v = c.oLanguage.oAria.paginate || {};
                    try {
                        n = P(t).find(y.activeElement).data("dt-idx");
                    } catch (t) {}
                    p(P(t).empty(), e),
                        n !== H &&
                            P(t)
                                .find("[data-dt-idx=" + n + "]")
                                .trigger("focus");
                },
            },
        }),
        P.extend(w.ext.type.detect, [
            function (t, e) {
                e = e.oLanguage.sDecimal;
                return l(t, e) ? "num" + e : null;
            },
            function (t, e) {
                var n;
                return (!t || t instanceof Date || X.test(t)) &&
                    ((null !== (n = Date.parse(t)) && !isNaN(n)) || h(t))
                    ? "date"
                    : null;
            },
            function (t, e) {
                e = e.oLanguage.sDecimal;
                return l(t, e, !0) ? "num-fmt" + e : null;
            },
            function (t, e) {
                e = e.oLanguage.sDecimal;
                return a(t, e) ? "html-num" + e : null;
            },
            function (t, e) {
                e = e.oLanguage.sDecimal;
                return a(t, e, !0) ? "html-num-fmt" + e : null;
            },
            function (t, e) {
                return h(t) || ("string" == typeof t && -1 !== t.indexOf("<"))
                    ? "html"
                    : null;
            },
        ]),
        P.extend(w.ext.type.search, {
            html: function (t) {
                return h(t)
                    ? t
                    : "string" == typeof t
                    ? t.replace(U, " ").replace(V, "")
                    : "";
            },
            string: function (t) {
                return !h(t) && "string" == typeof t ? t.replace(U, " ") : t;
            },
        });
    function ke(t, e, n, a) {
        var r;
        return 0 === t || (t && "-" !== t)
            ? "number" == (r = typeof t) || "bigint" == r
                ? t
                : +(t =
                      (t = e ? $(t, e) : t).replace &&
                      (n && (t = t.replace(n, "")), a)
                          ? t.replace(a, "")
                          : t)
            : -1 / 0;
    }
    function Me(n) {
        P.each(
            {
                num: function (t) {
                    return ke(t, n);
                },
                "num-fmt": function (t) {
                    return ke(t, n, q);
                },
                "html-num": function (t) {
                    return ke(t, n, V);
                },
                "html-num-fmt": function (t) {
                    return ke(t, n, V, q);
                },
            },
            function (t, e) {
                (p.type.order[t + n + "-pre"] = e),
                    t.match(/^html\-/) &&
                        (p.type.search[t + n] = p.type.search.html);
            }
        );
    }
    P.extend(p.type.order, {
        "date-pre": function (t) {
            t = Date.parse(t);
            return isNaN(t) ? -1 / 0 : t;
        },
        "html-pre": function (t) {
            return h(t)
                ? ""
                : t.replace
                ? t.replace(/<.*?>/g, "").toLowerCase()
                : t + "";
        },
        "string-pre": function (t) {
            return h(t)
                ? ""
                : "string" == typeof t
                ? t.toLowerCase()
                : t.toString
                ? t.toString()
                : "";
        },
        "string-asc": function (t, e) {
            return t < e ? -1 : e < t ? 1 : 0;
        },
        "string-desc": function (t, e) {
            return t < e ? 1 : e < t ? -1 : 0;
        },
    }),
        Me(""),
        P.extend(!0, w.ext.renderer, {
            header: {
                _: function (r, o, i, l) {
                    P(r.nTable).on("order.dt.DT", function (t, e, n, a) {
                        r === e &&
                            ((e = i.idx),
                            o
                                .removeClass(l.sSortAsc + " " + l.sSortDesc)
                                .addClass(
                                    "asc" == a[e]
                                        ? l.sSortAsc
                                        : "desc" == a[e]
                                        ? l.sSortDesc
                                        : i.sSortingClass
                                ));
                    });
                },
                jqueryui: function (r, o, i, l) {
                    P("<div/>")
                        .addClass(l.sSortJUIWrapper)
                        .append(o.contents())
                        .append(
                            P("<span/>").addClass(
                                l.sSortIcon + " " + i.sSortingClassJUI
                            )
                        )
                        .appendTo(o),
                        P(r.nTable).on("order.dt.DT", function (t, e, n, a) {
                            r === e &&
                                ((e = i.idx),
                                o
                                    .removeClass(l.sSortAsc + " " + l.sSortDesc)
                                    .addClass(
                                        "asc" == a[e]
                                            ? l.sSortAsc
                                            : "desc" == a[e]
                                            ? l.sSortDesc
                                            : i.sSortingClass
                                    ),
                                o
                                    .find("span." + l.sSortIcon)
                                    .removeClass(
                                        l.sSortJUIAsc +
                                            " " +
                                            l.sSortJUIDesc +
                                            " " +
                                            l.sSortJUI +
                                            " " +
                                            l.sSortJUIAscAllowed +
                                            " " +
                                            l.sSortJUIDescAllowed
                                    )
                                    .addClass(
                                        "asc" == a[e]
                                            ? l.sSortJUIAsc
                                            : "desc" == a[e]
                                            ? l.sSortJUIDesc
                                            : i.sSortingClassJUI
                                    ));
                        });
                },
            },
        });
    function We(t) {
        return "string" == typeof (t = Array.isArray(t) ? t.join(",") : t)
            ? t
                  .replace(/&/g, "&amp;")
                  .replace(/</g, "&lt;")
                  .replace(/>/g, "&gt;")
                  .replace(/"/g, "&quot;")
            : t;
    }
    function Ee(t, e, n, a, r) {
        return j.moment ? t[e](r) : j.luxon ? t[n](r) : a ? t[a](r) : t;
    }
    var Be = !1;
    function Ue(t, e, n) {
        var a;
        if (j.moment) {
            if (!(a = j.moment.utc(t, e, n, !0)).isValid()) return null;
        } else if (j.luxon) {
            if (
                !(a =
                    e && "string" == typeof t
                        ? j.luxon.DateTime.fromFormat(t, e)
                        : j.luxon.DateTime.fromISO(t)).isValid
            )
                return null;
            a.setLocale(n);
        } else
            e
                ? (Be ||
                      alert(
                          "DataTables warning: Formatted date without Moment.js or Luxon - https://datatables.net/tn/17"
                      ),
                  (Be = !0))
                : (a = new Date(t));
        return a;
    }
    function Ve(s) {
        return function (a, r, o, i) {
            0 === arguments.length
                ? ((o = "en"), (a = r = null))
                : 1 === arguments.length
                ? ((o = "en"), (r = a), (a = null))
                : 2 === arguments.length && ((o = r), (r = a), (a = null));
            var l = "datetime-" + r;
            return (
                w.ext.type.order[l] ||
                    (w.ext.type.detect.unshift(function (t) {
                        return t === l && l;
                    }),
                    (w.ext.type.order[l + "-asc"] = function (t, e) {
                        (t = t.valueOf()), (e = e.valueOf());
                        return t === e ? 0 : t < e ? -1 : 1;
                    }),
                    (w.ext.type.order[l + "-desc"] = function (t, e) {
                        (t = t.valueOf()), (e = e.valueOf());
                        return t === e ? 0 : e < t ? -1 : 1;
                    })),
                function (t, e) {
                    var n;
                    return (
                        (null !== t && t !== H) ||
                            (t =
                                "--now" === i
                                    ? ((n = new Date()),
                                      new Date(
                                          Date.UTC(
                                              n.getFullYear(),
                                              n.getMonth(),
                                              n.getDate(),
                                              n.getHours(),
                                              n.getMinutes(),
                                              n.getSeconds()
                                          )
                                      ))
                                    : ""),
                        "type" === e
                            ? l
                            : "" === t
                            ? "sort" !== e
                                ? ""
                                : Ue("0000-01-01 00:00:00", null, o)
                            : !(
                                  null === r ||
                                  a !== r ||
                                  "sort" === e ||
                                  "type" === e ||
                                  t instanceof Date
                              ) || null === (n = Ue(t, a, o))
                            ? t
                            : "sort" === e
                            ? n
                            : ((t =
                                  null === r
                                      ? Ee(n, "toDate", "toJSDate", "")[s]()
                                      : Ee(
                                            n,
                                            "format",
                                            "toFormat",
                                            "toISOString",
                                            r
                                        )),
                              "display" === e ? We(t) : t)
                    );
                }
            );
        };
    }
    var Xe = ",",
        Je = ".";
    if (j.Intl !== H)
        try {
            for (
                var qe = new Intl.NumberFormat().formatToParts(100000.1), n = 0;
                n < qe.length;
                n++
            )
                "group" === qe[n].type
                    ? (Xe = qe[n].value)
                    : "decimal" === qe[n].type && (Je = qe[n].value);
        } catch (t) {}
    function $e(e) {
        return function () {
            var t = [ge(this[w.ext.iApiIndex])].concat(
                Array.prototype.slice.call(arguments)
            );
            return w.ext.internal[e].apply(this, t);
        };
    }
    return (
        (w.datetime = function (n, a) {
            var r = "datetime-detect-" + n;
            (a = a || "en"),
                w.ext.type.order[r] ||
                    (w.ext.type.detect.unshift(function (t) {
                        var e = Ue(t, n, a);
                        return !("" !== t && !e) && r;
                    }),
                    (w.ext.type.order[r + "-pre"] = function (t) {
                        return Ue(t, n, a) || 0;
                    }));
        }),
        (w.render = {
            date: Ve("toLocaleDateString"),
            datetime: Ve("toLocaleString"),
            time: Ve("toLocaleTimeString"),
            number: function (a, r, o, i, l) {
                return (
                    (null !== a && a !== H) || (a = Xe),
                    (null !== r && r !== H) || (r = Je),
                    {
                        display: function (t) {
                            if ("number" != typeof t && "string" != typeof t)
                                return t;
                            if ("" === t || null === t) return t;
                            var e = t < 0 ? "-" : "",
                                n = parseFloat(t);
                            if (isNaN(n)) return We(t);
                            (n = n.toFixed(o)), (t = Math.abs(n));
                            (n = parseInt(t, 10)),
                                (t = o
                                    ? r + (t - n).toFixed(o).substring(2)
                                    : "");
                            return (
                                (e = 0 === n && 0 === parseFloat(t) ? "" : e) +
                                (i || "") +
                                n
                                    .toString()
                                    .replace(/\B(?=(\d{3})+(?!\d))/g, a) +
                                t +
                                (l || "")
                            );
                        },
                    }
                );
            },
            text: function () {
                return { display: We, filter: We };
            },
        }),
        P.extend(w.ext.internal, {
            _fnExternApiFunc: $e,
            _fnBuildAjax: Tt,
            _fnAjaxUpdate: xt,
            _fnAjaxParameters: At,
            _fnAjaxUpdateDraw: It,
            _fnAjaxDataSrc: Ft,
            _fnAddColumn: nt,
            _fnColumnOptions: at,
            _fnAdjustColumnSizing: O,
            _fnVisibleToColumnIndex: rt,
            _fnColumnIndexToVisible: ot,
            _fnVisbleColumns: T,
            _fnGetColumns: it,
            _fnColumnTypes: lt,
            _fnApplyColumnDefs: st,
            _fnHungarianMap: i,
            _fnCamelToHungarian: C,
            _fnLanguageCompat: Z,
            _fnBrowserDetect: tt,
            _fnAddData: x,
            _fnAddTr: ut,
            _fnNodeToDataIndex: function (t, e) {
                return e._DT_RowIndex !== H ? e._DT_RowIndex : null;
            },
            _fnNodeToColumnIndex: function (t, e, n) {
                return P.inArray(n, t.aoData[e].anCells);
            },
            _fnGetCellData: S,
            _fnSetCellData: ct,
            _fnSplitObjNotation: dt,
            _fnGetObjectDataFn: A,
            _fnSetObjectDataFn: b,
            _fnGetDataMaster: ht,
            _fnClearTable: pt,
            _fnDeleteIndex: gt,
            _fnInvalidate: bt,
            _fnGetRowElements: mt,
            _fnCreateTr: St,
            _fnBuildHead: yt,
            _fnDrawHead: Dt,
            _fnDraw: v,
            _fnReDraw: u,
            _fnAddOptionsHtml: _t,
            _fnDetectHeader: wt,
            _fnGetUniqueThs: Ct,
            _fnFeatureHtmlFilter: Lt,
            _fnFilterComplete: Rt,
            _fnFilterCustom: Pt,
            _fnFilterColumn: jt,
            _fnFilter: Ht,
            _fnFilterCreateSearch: Nt,
            _fnEscapeRegex: Ot,
            _fnFilterData: Wt,
            _fnFeatureHtmlInfo: Ut,
            _fnUpdateInfo: Vt,
            _fnInfoMacros: Xt,
            _fnInitialise: Jt,
            _fnInitComplete: qt,
            _fnLengthChange: $t,
            _fnFeatureHtmlLength: Gt,
            _fnFeatureHtmlPaginate: zt,
            _fnPageChange: Yt,
            _fnFeatureHtmlProcessing: Zt,
            _fnProcessingDisplay: D,
            _fnFeatureHtmlTable: Kt,
            _fnScrollDraw: Qt,
            _fnApplyToChildren: k,
            _fnCalculateColumnWidths: ee,
            _fnThrottle: ne,
            _fnConvertToWidth: ae,
            _fnGetWidestNode: re,
            _fnGetMaxLenString: oe,
            _fnStringToCss: M,
            _fnSortFlatten: I,
            _fnSort: ie,
            _fnSortAria: le,
            _fnSortListener: se,
            _fnSortAttachListener: ue,
            _fnSortingClasses: ce,
            _fnSortData: fe,
            _fnSaveState: de,
            _fnLoadState: he,
            _fnImplementState: pe,
            _fnSettingsFromNode: ge,
            _fnLog: W,
            _fnMap: F,
            _fnBindAction: me,
            _fnCallbackReg: L,
            _fnCallbackFire: R,
            _fnLengthOverflow: Se,
            _fnRenderer: ve,
            _fnDataSource: E,
            _fnRowAttributes: vt,
            _fnExtend: be,
            _fnCalculateEnd: function () {},
        }),
        (((P.fn.dataTable = w).$ = P).fn.dataTableSettings = w.settings),
        (P.fn.dataTableExt = w.ext),
        (P.fn.DataTable = function (t) {
            return P(this).dataTable(t).api();
        }),
        P.each(w, function (t, e) {
            P.fn.DataTable[t] = e;
        }),
        w
    );
});

/*! DataTables Bulma integration
 * ©2020 SpryMedia Ltd - datatables.net/license
 */
!(function (n) {
    var t, i;
    "function" == typeof define && define.amd
        ? define(["jquery", "datatables.net"], function (e) {
              return n(e, window, document);
          })
        : "object" == typeof exports
        ? ((t = require("jquery")),
          (i = function (e, a) {
              a.fn.dataTable || require("datatables.net")(e, a);
          }),
          "undefined" == typeof window
              ? (module.exports = function (e, a) {
                    return (
                        (e = e || window),
                        (a = a || t(e)),
                        i(e, a),
                        n(a, 0, e.document)
                    );
                })
              : (i(window, t),
                (module.exports = n(t, window, window.document))))
        : n(jQuery, window, document);
})(function (v, e, i, r) {
    "use strict";
    var s = v.fn.dataTable;
    return (
        v.extend(!0, s.defaults, {
            dom: "<'columns is-gapless is-multiline'<'column is-half'l><'column is-half'f><'column is-full'tr><'column is-half'i><'column is-half'p>>",
            renderer: "bulma",
        }),
        v.extend(s.ext.classes, {
            sWrapper: "dataTables_wrapper dt-bulma",
            sFilterInput: "input",
            sLengthSelect:
                "custom-select custom-select-sm form-control form-control-sm",
            sProcessing: "dataTables_processing card",
        }),
        (s.ext.renderer.pageButton.bulma = function (d, e, u, a, c, p) {
            function f(e, a) {
                for (
                    var n,
                        t,
                        i,
                        r,
                        s = function (e) {
                            e.preventDefault(),
                                v(e.currentTarget.firstChild).attr(
                                    "disabled"
                                ) ||
                                    g.page() == e.data.action ||
                                    g.page(e.data.action).draw("page");
                        },
                        l = 0,
                        o = a.length;
                    l < o;
                    l++
                )
                    if (((t = a[l]), Array.isArray(t))) f(e, t);
                    else {
                        switch (((b = m = ""), (r = !(i = "a")), t)) {
                            case "ellipsis":
                                (m = "&#x2026;"),
                                    (b = "pagination-link"),
                                    (r = !0),
                                    (i = "span");
                                break;
                            case "first":
                                (m = w.sFirst), (b = t), (r = c <= 0);
                                break;
                            case "previous":
                                (m = w.sPrevious), (b = t), (r = c <= 0);
                                break;
                            case "next":
                                (m = w.sNext), (b = t), (r = p - 1 <= c);
                                break;
                            case "last":
                                (m = w.sLast), (b = t), (r = p - 1 <= c);
                                break;
                            default:
                                (m = t + 1), (b = c === t ? "is-current" : "");
                        }
                        m &&
                            ((n = v("<li>", {
                                id:
                                    0 === u && "string" == typeof t
                                        ? d.sTableId + "_" + t
                                        : null,
                            })
                                .append(
                                    v("<" + i + ">", {
                                        href: r ? null : "#",
                                        "aria-controls": d.sTableId,
                                        "aria-disabled": r ? "true" : null,
                                        "aria-label": x[t],
                                        role: "link",
                                        "aria-current":
                                            "is-current" === b ? "page" : null,
                                        "data-dt-idx": t,
                                        tabindex: d.iTabIndex,
                                        class: "pagination-link " + b,
                                        disabled: r,
                                    }).html(m)
                                )
                                .appendTo(e)),
                            d.oApi._fnBindAction(n, { action: t }, s));
                    }
            }
            var m,
                b,
                n,
                g = new s.Api(d),
                w = (d.oClasses, d.oLanguage.oPaginate),
                x = d.oLanguage.oAria.paginate || {};
            try {
                n = v(e).find(i.activeElement).data("dt-idx");
            } catch (e) {}
            var t = v(
                '<nav class="pagination" role="navigation" aria-label="pagination"><ul class="pagination-list"></ul></nav>'
            );
            v(e).empty().append(t),
                f(t.find("ul"), a),
                n !== r &&
                    v(e)
                        .find("[data-dt-idx=" + n + "]")
                        .trigger("focus");
        }),
        v(i).on("init.dt", function (e, a) {
            "dt" === e.namespace &&
                ((e = new v.fn.dataTable.Api(a)),
                v("div.dataTables_length select", e.table().container()).wrap(
                    '<div class="select">'
                ));
        }),
        s
    );
});

/*! Buttons for DataTables 2.4.1
 * © SpryMedia Ltd - datatables.net/license
 */
!(function (e) {
    var o, i;
    "function" == typeof define && define.amd
        ? define(["jquery", "datatables.net"], function (t) {
              return e(t, window, document);
          })
        : "object" == typeof exports
        ? ((o = require("jquery")),
          (i = function (t, n) {
              n.fn.dataTable || require("datatables.net")(t, n);
          }),
          "undefined" == typeof window
              ? (module.exports = function (t, n) {
                    return (
                        (t = t || window),
                        (n = n || o(t)),
                        i(t, n),
                        e(n, t, t.document)
                    );
                })
              : (i(window, o),
                (module.exports = e(o, window, window.document))))
        : e(jQuery, window, document);
})(function (y, v, x, w) {
    "use strict";
    var e = y.fn.dataTable,
        o = 0,
        C = 0,
        _ = e.ext.buttons;
    function A(t, n, e) {
        y.fn.animate
            ? t.stop().fadeIn(n, e)
            : (t.css("display", "block"), e && e.call(t));
    }
    function k(t, n, e) {
        y.fn.animate
            ? t.stop().fadeOut(n, e)
            : (t.css("display", "none"), e && e.call(t));
    }
    function B(n, t) {
        if (!(this instanceof B))
            return function (t) {
                return new B(t, n).container();
            };
        !0 === (t = void 0 === t ? {} : t) && (t = {}),
            Array.isArray(t) && (t = { buttons: t }),
            (this.c = y.extend(!0, {}, B.defaults, t)),
            t.buttons && (this.c.buttons = t.buttons),
            (this.s = {
                dt: new e.Api(n),
                buttons: [],
                listenKeys: "",
                namespace: "dtb" + o++,
            }),
            (this.dom = {
                container: y("<" + this.c.dom.container.tag + "/>").addClass(
                    this.c.dom.container.className
                ),
            }),
            this._constructor();
    }
    y.extend(B.prototype, {
        action: function (t, n) {
            t = this._nodeToButton(t);
            return n === w ? t.conf.action : ((t.conf.action = n), this);
        },
        active: function (t, n) {
            var t = this._nodeToButton(t),
                e = this.c.dom.button.active,
                o = y(t.node);
            return (
                t.inCollection &&
                    this.c.dom.collection.button &&
                    this.c.dom.collection.button.active !== w &&
                    (e = this.c.dom.collection.button.active),
                n === w ? o.hasClass(e) : (o.toggleClass(e, n === w || n), this)
            );
        },
        add: function (t, n, e) {
            var o = this.s.buttons;
            if ("string" == typeof n) {
                for (
                    var i = n.split("-"), s = this.s, a = 0, r = i.length - 1;
                    a < r;
                    a++
                )
                    s = s.buttons[+i[a]];
                (o = s.buttons), (n = +i[i.length - 1]);
            }
            return (
                this._expandButton(
                    o,
                    t,
                    t !== w ? t.split : w,
                    (t === w || t.split === w || 0 === t.split.length) &&
                        s !== w,
                    !1,
                    n
                ),
                (e !== w && !0 !== e) || this._draw(),
                this
            );
        },
        collectionRebuild: function (t, n) {
            var e = this._nodeToButton(t);
            if (n !== w) {
                for (var o = e.buttons.length - 1; 0 <= o; o--)
                    this.remove(e.buttons[o].node);
                for (
                    e.conf.prefixButtons &&
                        n.unshift.apply(n, e.conf.prefixButtons),
                        e.conf.postfixButtons &&
                            n.push.apply(n, e.conf.postfixButtons),
                        o = 0;
                    o < n.length;
                    o++
                ) {
                    var i = n[o];
                    this._expandButton(
                        e.buttons,
                        i,
                        i !== w && i.config !== w && i.config.split !== w,
                        !0,
                        i.parentConf !== w && i.parentConf.split !== w,
                        null,
                        i.parentConf
                    );
                }
            }
            this._draw(e.collection, e.buttons);
        },
        container: function () {
            return this.dom.container;
        },
        disable: function (t) {
            t = this._nodeToButton(t);
            return (
                y(t.node)
                    .addClass(this.c.dom.button.disabled)
                    .prop("disabled", !0),
                this
            );
        },
        destroy: function () {
            y("body").off("keyup." + this.s.namespace);
            for (
                var t = this.s.buttons.slice(), n = 0, e = t.length;
                n < e;
                n++
            )
                this.remove(t[n].node);
            this.dom.container.remove();
            var o = this.s.dt.settings()[0];
            for (n = 0, e = o.length; n < e; n++)
                if (o.inst === this) {
                    o.splice(n, 1);
                    break;
                }
            return this;
        },
        enable: function (t, n) {
            return !1 === n
                ? this.disable(t)
                : ((n = this._nodeToButton(t)),
                  y(n.node)
                      .removeClass(this.c.dom.button.disabled)
                      .prop("disabled", !1),
                  this);
        },
        index: function (t, n, e) {
            n || ((n = ""), (e = this.s.buttons));
            for (var o = 0, i = e.length; o < i; o++) {
                var s = e[o].buttons;
                if (e[o].node === t) return n + o;
                if (s && s.length) {
                    s = this.index(t, o + "-", s);
                    if (null !== s) return s;
                }
            }
            return null;
        },
        name: function () {
            return this.c.name;
        },
        node: function (t) {
            return t
                ? ((t = this._nodeToButton(t)), y(t.node))
                : this.dom.container;
        },
        processing: function (t, n) {
            var e = this.s.dt,
                o = this._nodeToButton(t);
            return n === w
                ? y(o.node).hasClass("processing")
                : (y(o.node).toggleClass("processing", n),
                  y(e.table().node()).triggerHandler("buttons-processing.dt", [
                      n,
                      e.button(t),
                      e,
                      y(t),
                      o.conf,
                  ]),
                  this);
        },
        remove: function (t) {
            var n = this._nodeToButton(t),
                e = this._nodeToHost(t),
                o = this.s.dt;
            if (n.buttons.length)
                for (var i = n.buttons.length - 1; 0 <= i; i--)
                    this.remove(n.buttons[i].node);
            (n.conf.destroying = !0),
                n.conf.destroy &&
                    n.conf.destroy.call(o.button(t), o, y(t), n.conf),
                this._removeKey(n.conf),
                y(n.node).remove();
            o = y.inArray(n, e);
            return e.splice(o, 1), this;
        },
        text: function (t, n) {
            function e(t) {
                return "function" == typeof t ? t(i, s, o.conf) : t;
            }
            var o = this._nodeToButton(t),
                t = o.textNode,
                i = this.s.dt,
                s = y(o.node);
            return n === w
                ? e(o.conf.text)
                : ((o.conf.text = n), t.html(e(n)), this);
        },
        _constructor: function () {
            var e = this,
                t = this.s.dt,
                o = t.settings()[0],
                n = this.c.buttons;
            o._buttons || (o._buttons = []),
                o._buttons.push({ inst: this, name: this.c.name });
            for (var i = 0, s = n.length; i < s; i++) this.add(n[i]);
            t.on("destroy", function (t, n) {
                n === o && e.destroy();
            }),
                y("body").on("keyup." + this.s.namespace, function (t) {
                    var n;
                    (x.activeElement && x.activeElement !== x.body) ||
                        ((n = String.fromCharCode(t.keyCode).toLowerCase()),
                        -1 !== e.s.listenKeys.toLowerCase().indexOf(n) &&
                            e._keypress(n, t));
                });
        },
        _addKey: function (t) {
            t.key &&
                (this.s.listenKeys += (y.isPlainObject(t.key) ? t.key : t).key);
        },
        _draw: function (t, n) {
            t || ((t = this.dom.container), (n = this.s.buttons)),
                t.children().detach();
            for (var e = 0, o = n.length; e < o; e++)
                t.append(n[e].inserter),
                    t.append(" "),
                    n[e].buttons &&
                        n[e].buttons.length &&
                        this._draw(n[e].collection, n[e].buttons);
        },
        _expandButton: function (t, n, e, o, i, s, a) {
            for (
                var r,
                    l = this.s.dt,
                    c = this.c.dom.collection,
                    u = Array.isArray(n) ? n : [n],
                    d = 0,
                    f = (u = n === w ? (Array.isArray(e) ? e : [e]) : u).length;
                d < f;
                d++
            ) {
                var p = this._resolveExtends(u[d]);
                if (p)
                    if (
                        ((r = !(!p.config || !p.config.split)),
                        Array.isArray(p))
                    )
                        this._expandButton(
                            t,
                            p,
                            h !== w && h.conf !== w ? h.conf.split : w,
                            o,
                            a !== w && a.split !== w,
                            s,
                            a
                        );
                    else {
                        var h = this._buildButton(
                            p,
                            o,
                            p.split !== w ||
                                (p.config !== w && p.config.split !== w),
                            i
                        );
                        if (h) {
                            if (
                                (s !== w && null !== s
                                    ? (t.splice(s, 0, h), s++)
                                    : t.push(h),
                                h.conf.buttons &&
                                    ((h.collection = y(
                                        "<" + c.container.content.tag + "/>"
                                    )),
                                    (h.conf._collection = h.collection),
                                    y(h.node).append(c.action.dropHtml),
                                    this._expandButton(
                                        h.buttons,
                                        h.conf.buttons,
                                        h.conf.split,
                                        !r,
                                        r,
                                        s,
                                        h.conf
                                    )),
                                h.conf.split)
                            ) {
                                (h.collection = y(
                                    "<" + c.container.tag + "/>"
                                )),
                                    (h.conf._collection = h.collection);
                                for (var b = 0; b < h.conf.split.length; b++) {
                                    var g = h.conf.split[b];
                                    "object" == typeof g &&
                                        ((g.parent = a),
                                        g.collectionLayout === w &&
                                            (g.collectionLayout =
                                                h.conf.collectionLayout),
                                        g.dropup === w &&
                                            (g.dropup = h.conf.dropup),
                                        g.fade === w) &&
                                        (g.fade = h.conf.fade);
                                }
                                this._expandButton(
                                    h.buttons,
                                    h.conf.buttons,
                                    h.conf.split,
                                    !r,
                                    r,
                                    s,
                                    h.conf
                                );
                            }
                            (h.conf.parent = a),
                                p.init &&
                                    p.init.call(
                                        l.button(h.node),
                                        l,
                                        y(h.node),
                                        p
                                    );
                        }
                    }
            }
        },
        _buildButton: function (n, t, e, o) {
            function i(t) {
                return "function" == typeof t ? t(u, l, n) : t;
            }
            var s,
                a,
                r,
                l,
                c = this.c.dom,
                u = this.s.dt,
                d = y.extend(!0, {}, c.button);
            if (
                (t && e && c.collection.split
                    ? y.extend(!0, d, c.collection.split.action)
                    : o || t
                    ? y.extend(!0, d, c.collection.button)
                    : e && y.extend(!0, d, c.split.button),
                n.spacer)
            )
                return (
                    (c = y("<" + d.spacer.tag + "/>")
                        .addClass(
                            "dt-button-spacer " +
                                n.style +
                                " " +
                                d.spacer.className
                        )
                        .html(i(n.text))),
                    {
                        conf: n,
                        node: c,
                        inserter: c,
                        buttons: [],
                        inCollection: t,
                        isSplit: e,
                        collection: null,
                        textNode: c,
                    }
                );
            if (n.available && !n.available(u, n) && !n.hasOwnProperty("html"))
                return !1;
            n.hasOwnProperty("html")
                ? (l = y(n.html))
                : ((a = function (t, n, e, o) {
                      o.action.call(n.button(e), t, n, e, o),
                          y(n.table().node()).triggerHandler(
                              "buttons-action.dt",
                              [n.button(e), n, e, o]
                          );
                  }),
                  (c = n.tag || d.tag),
                  (r = n.clickBlurs === w || n.clickBlurs),
                  (l = y("<" + c + "/>")
                      .addClass(d.className)
                      .attr("tabindex", this.s.dt.settings()[0].iTabIndex)
                      .attr("aria-controls", this.s.dt.table().node().id)
                      .on("click.dtb", function (t) {
                          t.preventDefault(),
                              !l.hasClass(d.disabled) &&
                                  n.action &&
                                  a(t, u, l, n),
                              r && l.trigger("blur");
                      })
                      .on("keypress.dtb", function (t) {
                          13 === t.keyCode &&
                              (t.preventDefault(), !l.hasClass(d.disabled)) &&
                              n.action &&
                              a(t, u, l, n);
                      })),
                  "a" === c.toLowerCase() && l.attr("href", "#"),
                  "button" === c.toLowerCase() && l.attr("type", "button"),
                  (s = d.liner.tag
                      ? ((c = y("<" + d.liner.tag + "/>")
                            .html(i(n.text))
                            .addClass(d.liner.className)),
                        "a" === d.liner.tag.toLowerCase() &&
                            c.attr("href", "#"),
                        l.append(c),
                        c)
                      : (l.html(i(n.text)), l)),
                  !1 === n.enabled && l.addClass(d.disabled),
                  n.className && l.addClass(n.className),
                  n.titleAttr && l.attr("title", i(n.titleAttr)),
                  n.attr && l.attr(n.attr),
                  n.namespace || (n.namespace = ".dt-button-" + C++),
                  n.config !== w &&
                      n.config.split &&
                      (n.split = n.config.split));
            var f,
                p,
                h,
                b,
                g,
                m,
                c = this.c.dom.buttonContainer,
                c =
                    c && c.tag
                        ? y("<" + c.tag + "/>")
                              .addClass(c.className)
                              .append(l)
                        : l;
            return (
                this._addKey(n),
                this.c.buttonCreated && (c = this.c.buttonCreated(n, c)),
                e &&
                    ((p = (f = t
                        ? y.extend(
                              !0,
                              this.c.dom.split,
                              this.c.dom.collection.split
                          )
                        : this.c.dom.split).wrapper),
                    (h = y("<" + p.tag + "/>")
                        .addClass(p.className)
                        .append(l)),
                    (b = y.extend(n, {
                        align: f.dropdown.align,
                        attr: {
                            "aria-haspopup": "dialog",
                            "aria-expanded": !1,
                        },
                        className: f.dropdown.className,
                        closeButton: !1,
                        splitAlignClass: f.dropdown.splitAlignClass,
                        text: f.dropdown.text,
                    })),
                    this._addKey(b),
                    (g = function (t, n, e, o) {
                        _.split.action.call(n.button(h), t, n, e, o),
                            y(n.table().node()).triggerHandler(
                                "buttons-action.dt",
                                [n.button(e), n, e, o]
                            ),
                            e.attr("aria-expanded", !0);
                    }),
                    (m = y(
                        '<button class="' +
                            f.dropdown.className +
                            ' dt-button"></button>'
                    )
                        .html(f.dropdown.dropHtml)
                        .on("click.dtb", function (t) {
                            t.preventDefault(),
                                t.stopPropagation(),
                                m.hasClass(d.disabled) || g(t, u, m, b),
                                r && m.trigger("blur");
                        })
                        .on("keypress.dtb", function (t) {
                            13 === t.keyCode &&
                                (t.preventDefault(),
                                m.hasClass(d.disabled) || g(t, u, m, b));
                        })),
                    0 === n.split.length && m.addClass("dtb-hide-drop"),
                    h.append(m).attr(b.attr)),
                {
                    conf: n,
                    node: (e ? h : l).get(0),
                    inserter: e ? h : c,
                    buttons: [],
                    inCollection: t,
                    isSplit: e,
                    inSplit: o,
                    collection: null,
                    textNode: s,
                }
            );
        },
        _nodeToButton: function (t, n) {
            for (var e = 0, o = (n = n || this.s.buttons).length; e < o; e++) {
                if (n[e].node === t) return n[e];
                if (n[e].buttons.length) {
                    var i = this._nodeToButton(t, n[e].buttons);
                    if (i) return i;
                }
            }
        },
        _nodeToHost: function (t, n) {
            for (var e = 0, o = (n = n || this.s.buttons).length; e < o; e++) {
                if (n[e].node === t) return n;
                if (n[e].buttons.length) {
                    var i = this._nodeToHost(t, n[e].buttons);
                    if (i) return i;
                }
            }
        },
        _keypress: function (s, a) {
            var r;
            a._buttonsHandled ||
                (r = function (t) {
                    for (var n, e, o = 0, i = t.length; o < i; o++)
                        (n = t[o].conf),
                            (e = t[o].node),
                            !n.key ||
                                (n.key !== s &&
                                    (!y.isPlainObject(n.key) ||
                                        n.key.key !== s ||
                                        (n.key.shiftKey && !a.shiftKey) ||
                                        (n.key.altKey && !a.altKey) ||
                                        (n.key.ctrlKey && !a.ctrlKey) ||
                                        (n.key.metaKey && !a.metaKey))) ||
                                ((a._buttonsHandled = !0), y(e).click()),
                            t[o].buttons.length && r(t[o].buttons);
                })(this.s.buttons);
        },
        _removeKey: function (t) {
            var n;
            t.key &&
                ((t = (y.isPlainObject(t.key) ? t.key : t).key),
                (n = this.s.listenKeys.split("")),
                (t = y.inArray(t, n)),
                n.splice(t, 1),
                (this.s.listenKeys = n.join("")));
        },
        _resolveExtends: function (e) {
            function t(t) {
                for (var n = 0; !y.isPlainObject(t) && !Array.isArray(t); ) {
                    if (t === w) return;
                    if ("function" == typeof t) {
                        if (!(t = t.call(i, s, e))) return !1;
                    } else if ("string" == typeof t) {
                        if (!_[t]) return { html: t };
                        t = _[t];
                    }
                    if (30 < ++n) throw "Buttons: Too many iterations";
                }
                return Array.isArray(t) ? t : y.extend({}, t);
            }
            var n,
                o,
                i = this,
                s = this.s.dt;
            for (e = t(e); e && e.extend; ) {
                if (!_[e.extend])
                    throw "Cannot extend unknown button type: " + e.extend;
                var a = t(_[e.extend]);
                if (Array.isArray(a)) return a;
                if (!a) return !1;
                var r = a.className;
                e.config !== w &&
                    a.config !== w &&
                    (e.config = y.extend({}, a.config, e.config)),
                    (e = y.extend({}, a, e)),
                    r &&
                        e.className !== r &&
                        (e.className = r + " " + e.className),
                    (e.extend = a.extend);
            }
            var l = e.postfixButtons;
            if (l)
                for (
                    e.buttons || (e.buttons = []), n = 0, o = l.length;
                    n < o;
                    n++
                )
                    e.buttons.push(l[n]);
            var c = e.prefixButtons;
            if (c)
                for (
                    e.buttons || (e.buttons = []), n = 0, o = c.length;
                    n < o;
                    n++
                )
                    e.buttons.splice(n, 0, c[n]);
            return e;
        },
        _popover: function (o, t, n, e) {
            function i() {
                (h = !0),
                    k(y(g), b.fade, function () {
                        y(this).detach();
                    }),
                    y(
                        f
                            .buttons(
                                '[aria-haspopup="dialog"][aria-expanded="true"]'
                            )
                            .nodes()
                    ).attr("aria-expanded", "false"),
                    y("div.dt-button-background").off("click.dtb-collection"),
                    B.background(!1, b.backgroundClassName, b.fade, m),
                    y(v).off("resize.resize.dtb-collection"),
                    y("body").off(".dtb-collection"),
                    f.off("buttons-action.b-internal"),
                    f.off("destroy");
            }
            var s,
                a,
                r,
                l,
                c,
                u,
                d,
                f = t,
                p = this.c,
                h = !1,
                b = y.extend(
                    {
                        align: "button-left",
                        autoClose: !1,
                        background: !0,
                        backgroundClassName: "dt-button-background",
                        closeButton: !0,
                        containerClassName:
                            p.dom.collection.container.className,
                        contentClassName:
                            p.dom.collection.container.content.className,
                        collectionLayout: "",
                        collectionTitle: "",
                        dropup: !1,
                        fade: 400,
                        popoverTitle: "",
                        rightAlignClassName: "dt-button-right",
                        tag: p.dom.collection.container.tag,
                    },
                    n
                ),
                g = b.tag + "." + b.containerClassName.replace(/ /g, "."),
                m = t.node();
            !1 === o
                ? i()
                : ((p = y(
                      f
                          .buttons(
                              '[aria-haspopup="dialog"][aria-expanded="true"]'
                          )
                          .nodes()
                  )).length && (m.closest(g).length && (m = p.eq(0)), i()),
                  (n = y(".dt-button", o).length),
                  (p = ""),
                  3 === n
                      ? (p = "dtb-b3")
                      : 2 === n
                      ? (p = "dtb-b2")
                      : 1 === n && (p = "dtb-b1"),
                  (s = y("<" + b.tag + "/>")
                      .addClass(b.containerClassName)
                      .addClass(b.collectionLayout)
                      .addClass(b.splitAlignClass)
                      .addClass(p)
                      .css("display", "none")
                      .attr({ "aria-modal": !0, role: "dialog" })),
                  (o = y(o)
                      .addClass(b.contentClassName)
                      .attr("role", "menu")
                      .appendTo(s)),
                  m.attr("aria-expanded", "true"),
                  m.parents("body")[0] !== x.body && (m = x.body.lastChild),
                  b.popoverTitle
                      ? s.prepend(
                            '<div class="dt-button-collection-title">' +
                                b.popoverTitle +
                                "</div>"
                        )
                      : b.collectionTitle &&
                        s.prepend(
                            '<div class="dt-button-collection-title">' +
                                b.collectionTitle +
                                "</div>"
                        ),
                  b.closeButton &&
                      s
                          .prepend(
                              '<div class="dtb-popover-close">&times;</div>'
                          )
                          .addClass("dtb-collection-closeable"),
                  A(s.insertAfter(m), b.fade),
                  (n = y(t.table().container())),
                  (d = s.css("position")),
                  ("container" !== b.span && "dt-container" !== b.align) ||
                      ((m = m.parent()), s.css("width", n.width())),
                  "absolute" === d
                      ? ((p = y(m[0].offsetParent)),
                        (t = m.position()),
                        (n = m.offset()),
                        (a = p.offset()),
                        (r = p.position()),
                        (l = v.getComputedStyle(p[0])),
                        (a.height = p.outerHeight()),
                        (a.width = p.width() + parseFloat(l.paddingLeft)),
                        (a.right = a.left + a.width),
                        (a.bottom = a.top + a.height),
                        (p = t.top + m.outerHeight()),
                        (c = t.left),
                        s.css({ top: p, left: c }),
                        (l = v.getComputedStyle(s[0])),
                        ((u = s.offset()).height = s.outerHeight()),
                        (u.width = s.outerWidth()),
                        (u.right = u.left + u.width),
                        (u.bottom = u.top + u.height),
                        (u.marginTop = parseFloat(l.marginTop)),
                        (u.marginBottom = parseFloat(l.marginBottom)),
                        b.dropup &&
                            (p =
                                t.top -
                                u.height -
                                u.marginTop -
                                u.marginBottom),
                        ("button-right" !== b.align &&
                            !s.hasClass(b.rightAlignClassName)) ||
                            (c = t.left - u.width + m.outerWidth()),
                        ("dt-container" !== b.align &&
                            "container" !== b.align) ||
                            ((c = c < t.left ? -t.left : c) + u.width >
                                a.width &&
                                (c = a.width - u.width)),
                        r.left + c + u.width > y(v).width() &&
                            (c = y(v).width() - u.width - r.left),
                        n.left + c < 0 && (c = -n.left),
                        r.top + p + u.height >
                            y(v).height() + y(v).scrollTop() &&
                            (p =
                                t.top -
                                u.height -
                                u.marginTop -
                                u.marginBottom),
                        r.top + p < y(v).scrollTop() &&
                            (p = t.top + m.outerHeight()),
                        s.css({ top: p, left: c }))
                      : ((d = function () {
                            var t = y(v).height() / 2,
                                n = s.height() / 2;
                            s.css("marginTop", -1 * (n = t < n ? t : n));
                        })(),
                        y(v).on("resize.dtb-collection", function () {
                            d();
                        })),
                  b.background &&
                      B.background(
                          !0,
                          b.backgroundClassName,
                          b.fade,
                          b.backgroundHost || m
                      ),
                  y("div.dt-button-background").on(
                      "click.dtb-collection",
                      function () {}
                  ),
                  b.autoClose &&
                      setTimeout(function () {
                          f.on(
                              "buttons-action.b-internal",
                              function (t, n, e, o) {
                                  o[0] !== m[0] && i();
                              }
                          );
                      }, 0),
                  y(s).trigger("buttons-popover.dt"),
                  f.on("destroy", i),
                  setTimeout(function () {
                      (h = !1),
                          y("body")
                              .on("click.dtb-collection", function (t) {
                                  var n, e;
                                  !h &&
                                      ((n = y.fn.addBack
                                          ? "addBack"
                                          : "andSelf"),
                                      (e = y(t.target).parent()[0]),
                                      (!y(t.target).parents()[n]().filter(o)
                                          .length &&
                                          !y(e).hasClass("dt-buttons")) ||
                                          y(t.target).hasClass(
                                              "dt-button-background"
                                          )) &&
                                      i();
                              })
                              .on("keyup.dtb-collection", function (t) {
                                  27 === t.keyCode && i();
                              })
                              .on("keydown.dtb-collection", function (t) {
                                  var n = y("a, button", o),
                                      e = x.activeElement;
                                  9 === t.keyCode &&
                                      (-1 === n.index(e)
                                          ? (n.first().focus(),
                                            t.preventDefault())
                                          : t.shiftKey
                                          ? e === n[0] &&
                                            (n.last().focus(),
                                            t.preventDefault())
                                          : e === n.last()[0] &&
                                            (n.first().focus(),
                                            t.preventDefault()));
                              });
                  }, 0));
        },
    }),
        (B.background = function (t, n, e, o) {
            e === w && (e = 400),
                (o = o || x.body),
                t
                    ? A(
                          y("<div/>")
                              .addClass(n)
                              .css("display", "none")
                              .insertAfter(o),
                          e
                      )
                    : k(y("div." + n), e, function () {
                          y(this).removeClass(n).remove();
                      });
        }),
        (B.instanceSelector = function (t, i) {
            var s, a, r;
            return t === w || null === t
                ? y.map(i, function (t) {
                      return t.inst;
                  })
                : ((s = []),
                  (a = y.map(i, function (t) {
                      return t.name;
                  })),
                  (r = function (t) {
                      var n;
                      if (Array.isArray(t))
                          for (var e = 0, o = t.length; e < o; e++) r(t[e]);
                      else
                          "string" == typeof t
                              ? -1 !== t.indexOf(",")
                                  ? r(t.split(","))
                                  : -1 !== (n = y.inArray(t.trim(), a)) &&
                                    s.push(i[n].inst)
                              : "number" == typeof t
                              ? s.push(i[t].inst)
                              : "object" == typeof t && s.push(t);
                  })(t),
                  s);
        }),
        (B.buttonSelector = function (t, n) {
            for (
                var c = [],
                    u = function (t, n, e) {
                        for (var o, i, s = 0, a = n.length; s < a; s++)
                            (o = n[s]) &&
                                (t.push({
                                    node: o.node,
                                    name: o.conf.name,
                                    idx: (i = e !== w ? e + s : s + ""),
                                }),
                                o.buttons) &&
                                u(t, o.buttons, i + "-");
                    },
                    d = function (t, n) {
                        var e = [],
                            o =
                                (u(e, n.s.buttons),
                                y.map(e, function (t) {
                                    return t.node;
                                }));
                        if (Array.isArray(t) || t instanceof y)
                            for (s = 0, a = t.length; s < a; s++) d(t[s], n);
                        else if (null === t || t === w || "*" === t)
                            for (s = 0, a = e.length; s < a; s++)
                                c.push({ inst: n, node: e[s].node });
                        else if ("number" == typeof t)
                            n.s.buttons[t] &&
                                c.push({ inst: n, node: n.s.buttons[t].node });
                        else if ("string" == typeof t)
                            if (-1 !== t.indexOf(","))
                                for (
                                    var i = t.split(","), s = 0, a = i.length;
                                    s < a;
                                    s++
                                )
                                    d(i[s].trim(), n);
                            else if (t.match(/^\d+(\-\d+)*$/)) {
                                var r = y.map(e, function (t) {
                                    return t.idx;
                                });
                                c.push({
                                    inst: n,
                                    node: e[y.inArray(t, r)].node,
                                });
                            } else if (-1 !== t.indexOf(":name")) {
                                var l = t.replace(":name", "");
                                for (s = 0, a = e.length; s < a; s++)
                                    e[s].name === l &&
                                        c.push({ inst: n, node: e[s].node });
                            } else
                                y(o)
                                    .filter(t)
                                    .each(function () {
                                        c.push({ inst: n, node: this });
                                    });
                        else
                            "object" == typeof t &&
                                t.nodeName &&
                                -1 !== (r = y.inArray(t, o)) &&
                                c.push({ inst: n, node: o[r] });
                    },
                    e = 0,
                    o = t.length;
                e < o;
                e++
            ) {
                var i = t[e];
                d(n, i);
            }
            return c;
        }),
        (B.stripData = function (t, n) {
            return (
                "string" == typeof t &&
                    ((t = (t = t.replace(
                        /<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,
                        ""
                    )).replace(/<!\-\-.*?\-\->/g, "")),
                    (n && !n.stripHtml) || (t = t.replace(/<[^>]*>/g, "")),
                    (n && !n.trim) || (t = t.replace(/^\s+|\s+$/g, "")),
                    (n && !n.stripNewlines) || (t = t.replace(/\n/g, " ")),
                    !n || n.decodeEntities) &&
                    ((l.innerHTML = t), (t = l.value)),
                t
            );
        }),
        (B.defaults = {
            buttons: ["copy", "excel", "csv", "pdf", "print"],
            name: "main",
            tabIndex: 0,
            dom: {
                container: { tag: "div", className: "dt-buttons" },
                collection: {
                    action: {
                        dropHtml:
                            '<span class="dt-button-down-arrow">&#x25BC;</span>',
                    },
                    container: {
                        className: "dt-button-collection",
                        content: { className: "", tag: "div" },
                        tag: "div",
                    },
                },
                button: {
                    tag: "button",
                    className: "dt-button",
                    active: "dt-button-active",
                    disabled: "disabled",
                    spacer: { className: "dt-button-spacer", tag: "span" },
                    liner: { tag: "span", className: "" },
                },
                split: {
                    action: {
                        className: "dt-button-split-drop-button dt-button",
                        tag: "button",
                    },
                    dropdown: {
                        align: "split-right",
                        className: "dt-button-split-drop",
                        dropHtml:
                            '<span class="dt-button-down-arrow">&#x25BC;</span>',
                        splitAlignClass: "dt-button-split-left",
                        tag: "button",
                    },
                    wrapper: { className: "dt-button-split", tag: "div" },
                },
            },
        }),
        y.extend(_, {
            collection: {
                text: function (t) {
                    return t.i18n("buttons.collection", "Collection");
                },
                className: "buttons-collection",
                closeButton: !(B.version = "2.4.1"),
                init: function (t, n, e) {
                    n.attr("aria-expanded", !1);
                },
                action: function (t, n, e, o) {
                    o._collection.parents("body").length
                        ? this.popover(!1, o)
                        : this.popover(o._collection, o),
                        "keypress" === t.type &&
                            y("a, button", o._collection).eq(0).focus();
                },
                attr: { "aria-haspopup": "dialog" },
            },
            split: {
                text: function (t) {
                    return t.i18n("buttons.split", "Split");
                },
                className: "buttons-split",
                closeButton: !1,
                init: function (t, n, e) {
                    return n.attr("aria-expanded", !1);
                },
                action: function (t, n, e, o) {
                    this.popover(o._collection, o);
                },
                attr: { "aria-haspopup": "dialog" },
            },
            copy: function (t, n) {
                if (_.copyHtml5) return "copyHtml5";
            },
            csv: function (t, n) {
                if (_.csvHtml5 && _.csvHtml5.available(t, n)) return "csvHtml5";
            },
            excel: function (t, n) {
                if (_.excelHtml5 && _.excelHtml5.available(t, n))
                    return "excelHtml5";
            },
            pdf: function (t, n) {
                if (_.pdfHtml5 && _.pdfHtml5.available(t, n)) return "pdfHtml5";
            },
            pageLength: function (t) {
                var n = t.settings()[0].aLengthMenu,
                    e = [],
                    o = [];
                if (Array.isArray(n[0])) (e = n[0]), (o = n[1]);
                else
                    for (var i = 0; i < n.length; i++) {
                        var s = n[i];
                        y.isPlainObject(s)
                            ? (e.push(s.value), o.push(s.label))
                            : (e.push(s), o.push(s));
                    }
                return {
                    extend: "collection",
                    text: function (t) {
                        return t.i18n(
                            "buttons.pageLength",
                            { "-1": "Show all rows", _: "Show %d rows" },
                            t.page.len()
                        );
                    },
                    className: "buttons-page-length",
                    autoClose: !0,
                    buttons: y.map(e, function (s, t) {
                        return {
                            text: o[t],
                            className: "button-page-length",
                            action: function (t, n) {
                                n.page.len(s).draw();
                            },
                            init: function (t, n, e) {
                                function o() {
                                    i.active(t.page.len() === s);
                                }
                                var i = this;
                                t.on("length.dt" + e.namespace, o), o();
                            },
                            destroy: function (t, n, e) {
                                t.off("length.dt" + e.namespace);
                            },
                        };
                    }),
                    init: function (t, n, e) {
                        var o = this;
                        t.on("length.dt" + e.namespace, function () {
                            o.text(e.text);
                        });
                    },
                    destroy: function (t, n, e) {
                        t.off("length.dt" + e.namespace);
                    },
                };
            },
            spacer: {
                style: "empty",
                spacer: !0,
                text: function (t) {
                    return t.i18n("buttons.spacer", "");
                },
            },
        }),
        e.Api.register("buttons()", function (n, e) {
            e === w && ((e = n), (n = w)), (this.selector.buttonGroup = n);
            var t = this.iterator(
                !0,
                "table",
                function (t) {
                    if (t._buttons)
                        return B.buttonSelector(
                            B.instanceSelector(n, t._buttons),
                            e
                        );
                },
                !0
            );
            return (t._groupSelector = n), t;
        }),
        e.Api.register("button()", function (t, n) {
            t = this.buttons(t, n);
            return 1 < t.length && t.splice(1, t.length), t;
        }),
        e.Api.registerPlural(
            "buttons().active()",
            "button().active()",
            function (n) {
                return n === w
                    ? this.map(function (t) {
                          return t.inst.active(t.node);
                      })
                    : this.each(function (t) {
                          t.inst.active(t.node, n);
                      });
            }
        ),
        e.Api.registerPlural(
            "buttons().action()",
            "button().action()",
            function (n) {
                return n === w
                    ? this.map(function (t) {
                          return t.inst.action(t.node);
                      })
                    : this.each(function (t) {
                          t.inst.action(t.node, n);
                      });
            }
        ),
        e.Api.registerPlural(
            "buttons().collectionRebuild()",
            "button().collectionRebuild()",
            function (e) {
                return this.each(function (t) {
                    for (var n = 0; n < e.length; n++)
                        "object" == typeof e[n] && (e[n].parentConf = t);
                    t.inst.collectionRebuild(t.node, e);
                });
            }
        ),
        e.Api.register(
            ["buttons().enable()", "button().enable()"],
            function (n) {
                return this.each(function (t) {
                    t.inst.enable(t.node, n);
                });
            }
        ),
        e.Api.register(
            ["buttons().disable()", "button().disable()"],
            function () {
                return this.each(function (t) {
                    t.inst.disable(t.node);
                });
            }
        ),
        e.Api.register("button().index()", function () {
            var n = null;
            return (
                this.each(function (t) {
                    t = t.inst.index(t.node);
                    null !== t && (n = t);
                }),
                n
            );
        }),
        e.Api.registerPlural(
            "buttons().nodes()",
            "button().node()",
            function () {
                var n = y();
                return (
                    y(
                        this.each(function (t) {
                            n = n.add(t.inst.node(t.node));
                        })
                    ),
                    n
                );
            }
        ),
        e.Api.registerPlural(
            "buttons().processing()",
            "button().processing()",
            function (n) {
                return n === w
                    ? this.map(function (t) {
                          return t.inst.processing(t.node);
                      })
                    : this.each(function (t) {
                          t.inst.processing(t.node, n);
                      });
            }
        ),
        e.Api.registerPlural(
            "buttons().text()",
            "button().text()",
            function (n) {
                return n === w
                    ? this.map(function (t) {
                          return t.inst.text(t.node);
                      })
                    : this.each(function (t) {
                          t.inst.text(t.node, n);
                      });
            }
        ),
        e.Api.registerPlural(
            "buttons().trigger()",
            "button().trigger()",
            function () {
                return this.each(function (t) {
                    t.inst.node(t.node).trigger("click");
                });
            }
        ),
        e.Api.register("button().popover()", function (n, e) {
            return this.map(function (t) {
                return t.inst._popover(n, this.button(this[0].node), e);
            });
        }),
        e.Api.register("buttons().containers()", function () {
            var i = y(),
                s = this._groupSelector;
            return (
                this.iterator(!0, "table", function (t) {
                    if (t._buttons)
                        for (
                            var n = B.instanceSelector(s, t._buttons),
                                e = 0,
                                o = n.length;
                            e < o;
                            e++
                        )
                            i = i.add(n[e].container());
                }),
                i
            );
        }),
        e.Api.register("buttons().container()", function () {
            return this.containers().eq(0);
        }),
        e.Api.register("button().add()", function (t, n, e) {
            var o = this.context;
            return (
                o.length &&
                    (o = B.instanceSelector(this._groupSelector, o[0]._buttons))
                        .length &&
                    o[0].add(n, t, e),
                this.button(this._groupSelector, t)
            );
        }),
        e.Api.register("buttons().destroy()", function () {
            return (
                this.pluck("inst")
                    .unique()
                    .each(function (t) {
                        t.destroy();
                    }),
                this
            );
        }),
        e.Api.registerPlural(
            "buttons().remove()",
            "buttons().remove()",
            function () {
                return (
                    this.each(function (t) {
                        t.inst.remove(t.node);
                    }),
                    this
                );
            }
        ),
        e.Api.register("buttons.info()", function (t, n, e) {
            var o = this;
            return (
                !1 === t
                    ? (this.off("destroy.btn-info"),
                      k(y("#datatables_buttons_info"), 400, function () {
                          y(this).remove();
                      }),
                      clearTimeout(i),
                      (i = null))
                    : (i && clearTimeout(i),
                      y("#datatables_buttons_info").length &&
                          y("#datatables_buttons_info").remove(),
                      (t = t ? "<h2>" + t + "</h2>" : ""),
                      A(
                          y(
                              '<div id="datatables_buttons_info" class="dt-button-info"/>'
                          )
                              .html(t)
                              .append(
                                  y("<div/>")[
                                      "string" == typeof n ? "html" : "append"
                                  ](n)
                              )
                              .css("display", "none")
                              .appendTo("body")
                      ),
                      e !== w &&
                          0 !== e &&
                          (i = setTimeout(function () {
                              o.buttons.info(!1);
                          }, e)),
                      this.on("destroy.btn-info", function () {
                          o.buttons.info(!1);
                      })),
                this
            );
        }),
        e.Api.register("buttons.exportData()", function (t) {
            if (this.context.length) return c(new e.Api(this.context[0]), t);
        }),
        e.Api.register("buttons.exportInfo()", function (t) {
            return {
                filename: n((t = t || {})),
                title: a(t),
                messageTop: r(this, t.message || t.messageTop, "top"),
                messageBottom: r(this, t.messageBottom, "bottom"),
            };
        });
    var i,
        n = function (t) {
            var n;
            return (n =
                "function" ==
                typeof (n =
                    "*" === t.filename &&
                    "*" !== t.title &&
                    t.title !== w &&
                    null !== t.title &&
                    "" !== t.title
                        ? t.title
                        : t.filename)
                    ? n()
                    : n) === w || null === n
                ? null
                : (n = (n =
                      -1 !== n.indexOf("*")
                          ? n.replace("*", y("head > title").text()).trim()
                          : n).replace(
                      /[^a-zA-Z0-9_\u00A1-\uFFFF\.,\-_ !\(\)]/g,
                      ""
                  )) + (s(t.extension) || "");
        },
        s = function (t) {
            return null === t || t === w
                ? null
                : "function" == typeof t
                ? t()
                : t;
        },
        a = function (t) {
            t = s(t.title);
            return null === t
                ? null
                : -1 !== t.indexOf("*")
                ? t.replace("*", y("head > title").text() || "Exported data")
                : t;
        },
        r = function (t, n, e) {
            n = s(n);
            return null === n
                ? null
                : ((t = y("caption", t.table().container()).eq(0)),
                  "*" === n
                      ? t.css("caption-side") !== e
                          ? null
                          : t.length
                          ? t.text()
                          : ""
                      : n);
        },
        l = y("<textarea/>")[0],
        c = function (e, t) {
            for (
                var o = y.extend(
                        !0,
                        {},
                        {
                            rows: null,
                            columns: "",
                            modifier: { search: "applied", order: "applied" },
                            orthogonal: "display",
                            stripHtml: !0,
                            stripNewlines: !0,
                            decodeEntities: !0,
                            trim: !0,
                            format: {
                                header: function (t) {
                                    return B.stripData(t, o);
                                },
                                footer: function (t) {
                                    return B.stripData(t, o);
                                },
                                body: function (t) {
                                    return B.stripData(t, o);
                                },
                            },
                            customizeData: null,
                        },
                        t
                    ),
                    t = e
                        .columns(o.columns)
                        .indexes()
                        .map(function (t) {
                            var n = e.column(t).header();
                            return o.format.header(n.innerHTML, t, n);
                        })
                        .toArray(),
                    n = e.table().footer()
                        ? e
                              .columns(o.columns)
                              .indexes()
                              .map(function (t) {
                                  var n = e.column(t).footer();
                                  return o.format.footer(
                                      n ? n.innerHTML : "",
                                      t,
                                      n
                                  );
                              })
                              .toArray()
                        : null,
                    i = y.extend({}, o.modifier),
                    i =
                        (e.select &&
                            "function" == typeof e.select.info &&
                            i.selected === w &&
                            e
                                .rows(o.rows, y.extend({ selected: !0 }, i))
                                .any() &&
                            y.extend(i, { selected: !0 }),
                        e.rows(o.rows, i).indexes().toArray()),
                    i = e.cells(i, o.columns),
                    s = i.render(o.orthogonal).toArray(),
                    a = i.nodes().toArray(),
                    r = t.length,
                    l = [],
                    c = 0,
                    u = 0,
                    d = 0 < r ? s.length / r : 0;
                u < d;
                u++
            ) {
                for (var f = [r], p = 0; p < r; p++)
                    (f[p] = o.format.body(s[c], u, p, a[c])), c++;
                l[u] = f;
            }
            i = { header: t, footer: n, body: l };
            return o.customizeData && o.customizeData(i), i;
        };
    function t(t, n) {
        (t = new e.Api(t)), (n = n || t.init().buttons || e.defaults.buttons);
        return new B(t, n).container();
    }
    return (
        (y.fn.dataTable.Buttons = B),
        (y.fn.DataTable.Buttons = B),
        y(x).on("init.dt plugin-init.dt", function (t, n) {
            "dt" === t.namespace &&
                (t = n.oInit.buttons || e.defaults.buttons) &&
                !n._buttons &&
                new B(n, t).container();
        }),
        e.ext.feature.push({ fnInit: t, cFeature: "B" }),
        e.ext.features && e.ext.features.register("buttons", t),
        e
    );
});

/*! Bulma integration for DataTables' Buttons
 * © SpryMedia Ltd - datatables.net/license
 */
!(function (e) {
    var o, a;
    "function" == typeof define && define.amd
        ? define(
              ["jquery", "datatables.net-bm", "datatables.net-buttons"],
              function (t) {
                  return e(t, window, document);
              }
          )
        : "object" == typeof exports
        ? ((o = require("jquery")),
          (a = function (t, n) {
              n.fn.dataTable || require("datatables.net-bm")(t, n),
                  n.fn.dataTable.Buttons ||
                      require("datatables.net-buttons")(t, n);
          }),
          "undefined" == typeof window
              ? (module.exports = function (t, n) {
                    return (
                        (t = t || window),
                        (n = n || o(t)),
                        a(t, n),
                        e(n, 0, t.document)
                    );
                })
              : (a(window, o),
                (module.exports = e(o, window, window.document))))
        : e(jQuery, window, document);
})(function (e, t, n, o) {
    "use strict";
    var a = e.fn.dataTable;
    return (
        e.extend(!0, a.Buttons.defaults, {
            dom: {
                container: { className: "dt-buttons field is-grouped" },
                button: {
                    className: "button is-light",
                    active: "is-active",
                    disabled: "is-disabled",
                },
                collection: {
                    action: {
                        tag: "div",
                        className: "dropdown-content",
                        dropHtml: "",
                    },
                    button: {
                        tag: "a",
                        className: "dt-button dropdown-item",
                        active: "dt-button-active",
                        disabled: "is-disabled",
                        spacer: { className: "dropdown-divider", tag: "hr" },
                    },
                    closeButton: !1,
                    container: {
                        className: "dt-button-collection dropdown-menu",
                        content: { className: "dropdown-content" },
                    },
                },
                split: {
                    action: {
                        tag: "button",
                        className:
                            "dt-button-split-drop-button button is-light",
                        closeButton: !1,
                    },
                    dropdown: {
                        tag: "button",
                        dropHtml:
                            '<i class="fa fa-angle-down" aria-hidden="true"></i>',
                        className: "button is-light",
                        closeButton: !1,
                        align: "split-left",
                        splitAlignClass: "dt-button-split-left",
                    },
                    wrapper: {
                        tag: "div",
                        className:
                            "dt-button-split dropdown-trigger buttons has-addons",
                        closeButton: !1,
                    },
                },
            },
            buttonCreated: function (t, n) {
                return (
                    t.buttons &&
                        ((t._collection = e(
                            '<div class="dropdown-menu"/>'
                        ).append(t._collection)),
                        e(n).append(
                            '<span class="icon is-small"><i class="fa fa-angle-down" aria-hidden="true"></i></span>'
                        )),
                    n
                );
            },
        }),
        a
    );
});

/*!
 * Column visibility buttons for Buttons and DataTables.
 * © SpryMedia Ltd - datatables.net/license
 */
!(function (t) {
    var o, i;
    "function" == typeof define && define.amd
        ? define(
              ["jquery", "datatables.net", "datatables.net-buttons"],
              function (n) {
                  return t(n, window, document);
              }
          )
        : "object" == typeof exports
        ? ((o = require("jquery")),
          (i = function (n, e) {
              e.fn.dataTable || require("datatables.net")(n, e),
                  e.fn.dataTable.Buttons ||
                      require("datatables.net-buttons")(n, e);
          }),
          "undefined" == typeof window
              ? (module.exports = function (n, e) {
                    return (
                        (n = n || window),
                        (e = e || o(n)),
                        i(n, e),
                        t(e, 0, n.document)
                    );
                })
              : (i(window, o),
                (module.exports = t(o, window, window.document))))
        : t(jQuery, window, document);
})(function (n, e, t, l) {
    "use strict";
    var o = n.fn.dataTable;
    return (
        n.extend(o.ext.buttons, {
            colvis: function (o, i) {
                var l = null,
                    n = {
                        extend: "collection",
                        init: function (n, e) {
                            l = e;
                        },
                        text: function (n) {
                            return n.i18n(
                                "buttons.colvis",
                                "Column visibility"
                            );
                        },
                        className: "buttons-colvis",
                        closeButton: !1,
                        buttons: [
                            {
                                extend: "columnsToggle",
                                columns: i.columns,
                                columnText: i.columnText,
                            },
                        ],
                    };
                return (
                    o.on("column-reorder.dt" + i.namespace, function (n, e, t) {
                        o.button(
                            null,
                            o.button(null, l).node()
                        ).collectionRebuild([
                            {
                                extend: "columnsToggle",
                                columns: i.columns,
                                columnText: i.columnText,
                            },
                        ]);
                    }),
                    n
                );
            },
            columnsToggle: function (n, e) {
                return n
                    .columns(e.columns)
                    .indexes()
                    .map(function (n) {
                        return {
                            extend: "columnToggle",
                            columns: n,
                            columnText: e.columnText,
                        };
                    })
                    .toArray();
            },
            columnToggle: function (n, e) {
                return {
                    extend: "columnVisibility",
                    columns: e.columns,
                    columnText: e.columnText,
                };
            },
            columnsVisibility: function (n, e) {
                return n
                    .columns(e.columns)
                    .indexes()
                    .map(function (n) {
                        return {
                            extend: "columnVisibility",
                            columns: n,
                            visibility: e.visibility,
                            columnText: e.columnText,
                        };
                    })
                    .toArray();
            },
            columnVisibility: {
                columns: l,
                text: function (n, e, t) {
                    return t._columnText(n, t);
                },
                className: "buttons-columnVisibility",
                action: function (n, e, t, o) {
                    var e = e.columns(o.columns),
                        i = e.visible();
                    e.visible(
                        o.visibility !== l ? o.visibility : !(i.length && i[0])
                    );
                },
                init: function (o, n, i) {
                    var l = this;
                    n.attr("data-cv-idx", i.columns),
                        o
                            .on(
                                "column-visibility.dt" + i.namespace,
                                function (n, e) {
                                    e.bDestroying ||
                                        e.nTable != o.settings()[0].nTable ||
                                        l.active(o.column(i.columns).visible());
                                }
                            )
                            .on(
                                "column-reorder.dt" + i.namespace,
                                function (n, e, t) {
                                    i.destroying ||
                                        (1 === o.columns(i.columns).count() &&
                                            (l.text(i._columnText(o, i)),
                                            l.active(
                                                o.column(i.columns).visible()
                                            )));
                                }
                            ),
                        this.active(o.column(i.columns).visible());
                },
                destroy: function (n, e, t) {
                    n.off("column-visibility.dt" + t.namespace).off(
                        "column-reorder.dt" + t.namespace
                    );
                },
                _columnText: function (n, e) {
                    var t = n.column(e.columns).index(),
                        o = n.settings()[0].aoColumns[t].sTitle;
                    return (
                        (o = (o = o || n.column(t).header().innerHTML)
                            .replace(/\n/g, " ")
                            .replace(/<br\s*\/?>/gi, " ")
                            .replace(/<select(.*?)<\/select>/g, "")
                            .replace(/<!\-\-.*?\-\->/g, "")
                            .replace(/<.*?>/g, "")
                            .replace(/^\s+|\s+$/g, "")),
                        e.columnText ? e.columnText(n, t, o) : o
                    );
                },
            },
            colvisRestore: {
                className: "buttons-colvisRestore",
                text: function (n) {
                    return n.i18n(
                        "buttons.colvisRestore",
                        "Restore visibility"
                    );
                },
                init: function (e, n, t) {
                    t._visOriginal = e
                        .columns()
                        .indexes()
                        .map(function (n) {
                            return e.column(n).visible();
                        })
                        .toArray();
                },
                action: function (n, e, t, o) {
                    e.columns().every(function (n) {
                        n =
                            e.colReorder && e.colReorder.transpose
                                ? e.colReorder.transpose(n, "toOriginal")
                                : n;
                        this.visible(o._visOriginal[n]);
                    });
                },
            },
            colvisGroup: {
                className: "buttons-colvisGroup",
                action: function (n, e, t, o) {
                    e.columns(o.show).visible(!0, !1),
                        e.columns(o.hide).visible(!1, !1),
                        e.columns.adjust();
                },
                show: [],
                hide: [],
            },
        }),
        o
    );
});

/*! FixedHeader 3.4.0
 * © SpryMedia Ltd - datatables.net/license
 */
!(function (o) {
    var i, s;
    "function" == typeof define && define.amd
        ? define(["jquery", "datatables.net"], function (t) {
              return o(t, window, document);
          })
        : "object" == typeof exports
        ? ((i = require("jquery")),
          (s = function (t, e) {
              e.fn.dataTable || require("datatables.net")(t, e);
          }),
          "undefined" == typeof window
              ? (module.exports = function (t, e) {
                    return (
                        (t = t || window),
                        (e = e || i(t)),
                        s(t, e),
                        o(e, t, t.document)
                    );
                })
              : (s(window, i),
                (module.exports = o(i, window, window.document))))
        : o(jQuery, window, document);
})(function (m, H, x, v) {
    "use strict";
    function s(t, e) {
        if (!(this instanceof s))
            throw "FixedHeader must be initialised with the 'new' keyword.";
        if (
            (!0 === e && (e = {}),
            (t = new n.Api(t)),
            (this.c = m.extend(!0, {}, s.defaults, e)),
            (this.s = {
                dt: t,
                position: {
                    theadTop: 0,
                    tbodyTop: 0,
                    tfootTop: 0,
                    tfootBottom: 0,
                    width: 0,
                    left: 0,
                    tfootHeight: 0,
                    theadHeight: 0,
                    windowHeight: m(H).height(),
                    visible: !0,
                },
                headerMode: null,
                footerMode: null,
                autoWidth: t.settings()[0].oFeatures.bAutoWidth,
                namespace: ".dtfc" + o++,
                scrollLeft: { header: -1, footer: -1 },
                enable: !0,
                autoDisable: !1,
            }),
            (this.dom = {
                floatingHeader: null,
                thead: m(t.table().header()),
                tbody: m(t.table().body()),
                tfoot: m(t.table().footer()),
                header: {
                    host: null,
                    floating: null,
                    floatingParent: m('<div class="dtfh-floatingparent">'),
                    placeholder: null,
                },
                footer: {
                    host: null,
                    floating: null,
                    floatingParent: m('<div class="dtfh-floatingparent">'),
                    placeholder: null,
                },
            }),
            (this.dom.header.host = this.dom.thead.parent()),
            (this.dom.footer.host = this.dom.tfoot.parent()),
            (e = t.settings()[0])._fixedHeader)
        )
            throw "FixedHeader already initialised on table " + e.nTable.id;
        (e._fixedHeader = this)._constructor();
    }
    var n = m.fn.dataTable,
        o = 0;
    return (
        m.extend(s.prototype, {
            destroy: function () {
                var t = this.dom;
                this.s.dt.off(".dtfc"),
                    m(H).off(this.s.namespace),
                    t.header.rightBlocker && t.header.rightBlocker.remove(),
                    t.header.leftBlocker && t.header.leftBlocker.remove(),
                    t.footer.rightBlocker && t.footer.rightBlocker.remove(),
                    t.footer.leftBlocker && t.footer.leftBlocker.remove(),
                    this.c.header && this._modeChange("in-place", "header", !0),
                    this.c.footer &&
                        t.tfoot.length &&
                        this._modeChange("in-place", "footer", !0);
            },
            enable: function (t, e, o) {
                (this.s.enable = t),
                    (this.s.enableType = o),
                    (!e && e !== v) || (this._positions(), this._scroll(!0));
            },
            enabled: function () {
                return this.s.enable;
            },
            headerOffset: function (t) {
                return (
                    t !== v && ((this.c.headerOffset = t), this.update()),
                    this.c.headerOffset
                );
            },
            footerOffset: function (t) {
                return (
                    t !== v && ((this.c.footerOffset = t), this.update()),
                    this.c.footerOffset
                );
            },
            update: function (t) {
                var e = this.s.dt.table().node();
                (this.s.enable || this.s.autoDisable) &&
                    (m(e).is(":visible")
                        ? ((this.s.autoDisable = !1), this.enable(!0, !1))
                        : ((this.s.autoDisable = !0), this.enable(!1, !1)),
                    0 !== m(e).children("thead").length) &&
                    (this._positions(), this._scroll(t === v || t));
            },
            _constructor: function () {
                var o = this,
                    i = this.s.dt,
                    t =
                        (m(H)
                            .on("scroll" + this.s.namespace, function () {
                                o._scroll();
                            })
                            .on(
                                "resize" + this.s.namespace,
                                n.util.throttle(function () {
                                    (o.s.position.windowHeight = m(H).height()),
                                        o.update();
                                }, 50)
                            ),
                        m(".fh-fixedHeader")),
                    t =
                        (!this.c.headerOffset &&
                            t.length &&
                            (this.c.headerOffset = t.outerHeight()),
                        m(".fh-fixedFooter"));
                !this.c.footerOffset &&
                    t.length &&
                    (this.c.footerOffset = t.outerHeight()),
                    i
                        .on(
                            "column-reorder.dt.dtfc column-visibility.dt.dtfc column-sizing.dt.dtfc responsive-display.dt.dtfc",
                            function (t, e) {
                                o.update();
                            }
                        )
                        .on("draw.dt.dtfc", function (t, e) {
                            o.update(e !== i.settings()[0]);
                        }),
                    i.on("destroy.dtfc", function () {
                        o.destroy();
                    }),
                    this._positions(),
                    this._scroll();
            },
            _clone: function (t, e) {
                var o,
                    i,
                    s = this,
                    n = this.s.dt,
                    r = this.dom[t],
                    d = "header" === t ? this.dom.thead : this.dom.tfoot;
                ("footer" === t && this._scrollEnabled()) ||
                    (!e && r.floating
                        ? r.floating.removeClass(
                              "fixedHeader-floating fixedHeader-locked"
                          )
                        : (r.floating &&
                              (null !== r.placeholder && r.placeholder.remove(),
                              this._unsize(t),
                              r.floating.children().detach(),
                              r.floating.remove()),
                          (e = m(n.table().node())),
                          (o = m(e.parent())),
                          (i = this._scrollEnabled()),
                          (r.floating = m(n.table().node().cloneNode(!1))
                              .attr("aria-hidden", "true")
                              .css({ "table-layout": "fixed", top: 0, left: 0 })
                              .removeAttr("id")
                              .append(d)),
                          r.floatingParent
                              .css({
                                  width: o.width(),
                                  overflow: "hidden",
                                  height: "fit-content",
                                  position: "fixed",
                                  left: i
                                      ? e.offset().left + o.scrollLeft()
                                      : 0,
                              })
                              .css(
                                  "header" === t
                                      ? { top: this.c.headerOffset, bottom: "" }
                                      : { top: "", bottom: this.c.footerOffset }
                              )
                              .addClass(
                                  "footer" === t
                                      ? "dtfh-floatingparentfoot"
                                      : "dtfh-floatingparenthead"
                              )
                              .append(r.floating)
                              .appendTo("body"),
                          this._stickyPosition(r.floating, "-"),
                          (n = function () {
                              var t = o.scrollLeft();
                              (s.s.scrollLeft = { footer: t, header: t }),
                                  r.floatingParent.scrollLeft(
                                      s.s.scrollLeft.header
                                  );
                          })(),
                          o.off("scroll.dtfh").on("scroll.dtfh", n),
                          (r.placeholder = d.clone(!1)),
                          r.placeholder.find("*[id]").removeAttr("id"),
                          r.host.prepend(r.placeholder),
                          this._matchWidths(r.placeholder, r.floating)));
            },
            _stickyPosition: function (t, i) {
                var s, n;
                this._scrollEnabled() &&
                    ((n =
                        "rtl" ===
                        m((s = this).s.dt.table().node()).css("direction")),
                    t.find("th").each(function () {
                        var t, e, o;
                        "sticky" === m(this).css("position") &&
                            ((t = m(this).css("right")),
                            (e = m(this).css("left")),
                            "auto" === t || n
                                ? "auto" !== e &&
                                  n &&
                                  ((o =
                                      +e.replace(/px/g, "") +
                                      ("-" === i ? -1 : 1) *
                                          s.s.dt.settings()[0].oBrowser
                                              .barWidth),
                                  m(this).css("left", 0 < o ? o : 0))
                                : ((o =
                                      +t.replace(/px/g, "") +
                                      ("-" === i ? -1 : 1) *
                                          s.s.dt.settings()[0].oBrowser
                                              .barWidth),
                                  m(this).css("right", 0 < o ? o : 0)));
                    }));
            },
            _matchWidths: function (e, o) {
                function t(t) {
                    return m(t, e)
                        .map(function () {
                            return +m(this)
                                .css("width")
                                .replace(/[^\d\.]/g, "");
                        })
                        .toArray();
                }
                function i(t, e) {
                    m(t, o).each(function (t) {
                        m(this).css({ width: e[t], minWidth: e[t] });
                    });
                }
                var s = t("th"),
                    n = t("td");
                i("th", s), i("td", n);
            },
            _unsize: function (t) {
                var e = this.dom[t].floating;
                e && ("footer" === t || ("header" === t && !this.s.autoWidth))
                    ? m("th, td", e).css({ width: "", minWidth: "" })
                    : e &&
                      "header" === t &&
                      m("th, td", e).css("min-width", "");
            },
            _horizontal: function (t, e) {
                var o,
                    i = this.dom[t],
                    s = (this.s.position, this.s.scrollLeft);
                i.floating &&
                    s[t] !== e &&
                    (this._scrollEnabled() &&
                        ((o = m(
                            m(this.s.dt.table().node()).parent()
                        ).scrollLeft()),
                        i.floating.scrollLeft(o),
                        i.floatingParent.scrollLeft(o)),
                    (s[t] = e));
            },
            _modeChange: function (t, e, o) {
                this.s.dt;
                var i,
                    s,
                    n,
                    r,
                    d,
                    a,
                    h,
                    f = this.dom[e],
                    l = this.s.position,
                    c = this._scrollEnabled();
                ("footer" === e && c) ||
                    ((i = function (o) {
                        f.floating.attr("style", function (t, e) {
                            return (e || "") + "width: " + o + "px !important;";
                        }),
                            c ||
                                f.floatingParent.attr("style", function (t, e) {
                                    return (
                                        (e || "") +
                                        "width: " +
                                        o +
                                        "px !important;"
                                    );
                                });
                    }),
                    (r = this.dom["footer" === e ? "tfoot" : "thead"]),
                    (s = m.contains(r[0], x.activeElement)
                        ? x.activeElement
                        : null),
                    (d = m(m(this.s.dt.table().node()).parent())),
                    "in-place" === t
                        ? (f.placeholder &&
                              (f.placeholder.remove(), (f.placeholder = null)),
                          this._unsize(e),
                          "header" === e ? f.host.prepend(r) : f.host.append(r),
                          f.floating &&
                              (f.floating.remove(),
                              (f.floating = null),
                              this._stickyPosition(f.host, "+")),
                          f.floatingParent && f.floatingParent.remove(),
                          m(m(f.host.parent()).parent()).scrollLeft(
                              d.scrollLeft()
                          ))
                        : "in" === t
                        ? (this._clone(e, o),
                          (r = d.offset()),
                          (h = (n = m(x).scrollTop()) + m(H).height()),
                          (a = c ? r.top : l.tbodyTop),
                          (r = c ? r.top + d.outerHeight() : l.tfootTop),
                          (d =
                              "footer" === e
                                  ? h < a
                                      ? l.tfootHeight
                                      : a + l.tfootHeight - h
                                  : n +
                                    this.c.headerOffset +
                                    l.theadHeight -
                                    r),
                          (a = "header" === e ? "top" : "bottom"),
                          (h = this.c[e + "Offset"] - (0 < d ? d : 0)),
                          f.floating.addClass("fixedHeader-floating"),
                          f.floatingParent
                              .css(a, h)
                              .css({
                                  left: l.left,
                                  height:
                                      "header" === e
                                          ? l.theadHeight
                                          : l.tfootHeight,
                                  "z-index": 2,
                              })
                              .append(f.floating),
                          i(l.width),
                          "footer" === e && f.floating.css("top", ""))
                        : "below" === t
                        ? (this._clone(e, o),
                          f.floating.addClass("fixedHeader-locked"),
                          f.floatingParent.css({
                              position: "absolute",
                              top: l.tfootTop - l.theadHeight,
                              left: l.left + "px",
                          }),
                          i(l.width))
                        : "above" === t &&
                          (this._clone(e, o),
                          f.floating.addClass("fixedHeader-locked"),
                          f.floatingParent.css({
                              position: "absolute",
                              top: l.tbodyTop,
                              left: l.left + "px",
                          }),
                          i(l.width)),
                    s &&
                        s !== x.activeElement &&
                        setTimeout(function () {
                            s.focus();
                        }, 10),
                    (this.s.scrollLeft.header = -1),
                    (this.s.scrollLeft.footer = -1),
                    (this.s[e + "Mode"] = t));
            },
            _positions: function () {
                var t = this.s.dt,
                    e = t.table(),
                    o = this.s.position,
                    i = this.dom,
                    e = m(e.node()),
                    s = this._scrollEnabled(),
                    n = m(t.table().header()),
                    t = m(t.table().footer()),
                    i = i.tbody,
                    r = e.parent();
                (o.visible = e.is(":visible")),
                    (o.width = e.outerWidth()),
                    (o.left = e.offset().left),
                    (o.theadTop = n.offset().top),
                    (o.tbodyTop = (s ? r : i).offset().top),
                    (o.tbodyHeight = (s ? r : i).outerHeight()),
                    (o.theadHeight = n.outerHeight()),
                    (o.theadBottom = o.theadTop + o.theadHeight),
                    t.length
                        ? ((o.tfootTop = o.tbodyTop + o.tbodyHeight),
                          (o.tfootBottom = o.tfootTop + t.outerHeight()),
                          (o.tfootHeight = t.outerHeight()))
                        : ((o.tfootTop = o.tbodyTop + i.outerHeight()),
                          (o.tfootBottom = o.tfootTop),
                          (o.tfootHeight = o.tfootTop));
            },
            _scroll: function (t) {
                var e, o, i, s, n, r, d, a, h, f, l, c, u, p, g, b;
                this.s.dt.settings()[0].bDestroying ||
                    ((e = this._scrollEnabled()),
                    (o = (f = m(this.s.dt.table().node()).parent()).offset()),
                    (c = f.outerHeight()),
                    (i = m(x).scrollLeft()),
                    (s = m(x).scrollTop()),
                    (a = (l = m(H).height()) + s),
                    (u = this.s.position),
                    (b = e ? o.top : u.tbodyTop),
                    (r = (e ? o : u).left),
                    (c = e ? o.top + c : u.tfootTop),
                    (d = e ? f.outerWidth() : u.tbodyWidth),
                    (a = s + l),
                    this.c.header &&
                        (!this.s.enable ||
                        !u.visible ||
                        s + this.c.headerOffset + u.theadHeight <= b
                            ? (h = "in-place")
                            : s + this.c.headerOffset + u.theadHeight > b &&
                              s + this.c.headerOffset + u.theadHeight < c
                            ? ((h = "in"),
                              (f = m(m(this.s.dt.table().node()).parent())),
                              s + this.c.headerOffset + u.theadHeight > c ||
                              this.dom.header.floatingParent === v
                                  ? (t = !0)
                                  : this.dom.header.floatingParent
                                        .css({
                                            top: this.c.headerOffset,
                                            position: "fixed",
                                        })
                                        .append(this.dom.header.floating))
                            : (h = "below"),
                        (!t && h === this.s.headerMode) ||
                            this._modeChange(h, "header", t),
                        this._horizontal("header", i)),
                    (p = { offset: { top: 0, left: 0 }, height: 0 }),
                    (g = { offset: { top: 0, left: 0 }, height: 0 }),
                    this.c.footer &&
                        this.dom.tfoot.length &&
                        (!this.s.enable ||
                        !u.visible ||
                        u.tfootBottom + this.c.footerOffset <= a
                            ? (n = "in-place")
                            : c + u.tfootHeight + this.c.footerOffset > a &&
                              b + this.c.footerOffset < a
                            ? ((n = "in"), (t = !0))
                            : (n = "above"),
                        (!t && n === this.s.footerMode) ||
                            this._modeChange(n, "footer", t),
                        this._horizontal("footer", i),
                        (l = function (t) {
                            return {
                                offset: t.offset(),
                                height: t.outerHeight(),
                            };
                        }),
                        (p = this.dom.header.floating
                            ? l(this.dom.header.floating)
                            : l(this.dom.thead)),
                        (g = this.dom.footer.floating
                            ? l(this.dom.footer.floating)
                            : l(this.dom.tfoot)),
                        e) &&
                        g.offset.top > s &&
                        ((u =
                            a +
                            ((c = s - o.top) > -p.height ? c : 0) -
                            (p.offset.top +
                                (c < -p.height ? p.height : 0) +
                                g.height)),
                        f.outerHeight((u = u < 0 ? 0 : u)),
                        Math.round(f.outerHeight()) >= Math.round(u)
                            ? m(this.dom.tfoot.parent()).addClass(
                                  "fixedHeader-floating"
                              )
                            : m(this.dom.tfoot.parent()).removeClass(
                                  "fixedHeader-floating"
                              )),
                    this.dom.header.floating &&
                        this.dom.header.floatingParent.css("left", r - i),
                    this.dom.footer.floating &&
                        this.dom.footer.floatingParent.css("left", r - i),
                    this.s.dt.settings()[0]._fixedColumns !== v &&
                        ((this.dom.header.rightBlocker = (b = function (
                            t,
                            e,
                            o
                        ) {
                            var i;
                            return (
                                null !==
                                    (o =
                                        o === v
                                            ? 0 ===
                                              (i = m(
                                                  "div.dtfc-" +
                                                      t +
                                                      "-" +
                                                      e +
                                                      "-blocker"
                                              )).length
                                                ? null
                                                : i.clone().css("z-index", 1)
                                            : o) &&
                                    ("in" === h || "below" === h
                                        ? o
                                              .appendTo("body")
                                              .css({
                                                  top: ("top" === e ? p : g)
                                                      .offset.top,
                                                  left:
                                                      "right" === t
                                                          ? r + d - o.width()
                                                          : r,
                                              })
                                        : o.detach()),
                                o
                            );
                        })("right", "top", this.dom.header.rightBlocker)),
                        (this.dom.header.leftBlocker = b(
                            "left",
                            "top",
                            this.dom.header.leftBlocker
                        )),
                        (this.dom.footer.rightBlocker = b(
                            "right",
                            "bottom",
                            this.dom.footer.rightBlocker
                        )),
                        (this.dom.footer.leftBlocker = b(
                            "left",
                            "bottom",
                            this.dom.footer.leftBlocker
                        ))));
            },
            _scrollEnabled: function () {
                var t = this.s.dt.settings()[0].oScroll;
                return "" !== t.sY || "" !== t.sX;
            },
        }),
        (s.version = "3.4.0"),
        (s.defaults = {
            header: !0,
            footer: !1,
            headerOffset: 0,
            footerOffset: 0,
        }),
        (m.fn.dataTable.FixedHeader = s),
        (m.fn.DataTable.FixedHeader = s),
        m(x).on("init.dt.dtfh", function (t, e, o) {
            var i;
            "dt" === t.namespace &&
                ((t = e.oInit.fixedHeader),
                (i = n.defaults.fixedHeader),
                t || i) &&
                !e._fixedHeader &&
                ((i = m.extend({}, i, t)), !1 !== t) &&
                new s(e, i);
        }),
        n.Api.register("fixedHeader()", function () {}),
        n.Api.register("fixedHeader.adjust()", function () {
            return this.iterator("table", function (t) {
                t = t._fixedHeader;
                t && t.update();
            });
        }),
        n.Api.register("fixedHeader.enable()", function (e) {
            return this.iterator("table", function (t) {
                t = t._fixedHeader;
                (e = e === v || e), t && e !== t.enabled() && t.enable(e);
            });
        }),
        n.Api.register("fixedHeader.enabled()", function () {
            if (this.context.length) {
                var t = this.context[0]._fixedHeader;
                if (t) return t.enabled();
            }
            return !1;
        }),
        n.Api.register("fixedHeader.disable()", function () {
            return this.iterator("table", function (t) {
                t = t._fixedHeader;
                t && t.enabled() && t.enable(!1);
            });
        }),
        m.each(["header", "footer"], function (t, o) {
            n.Api.register("fixedHeader." + o + "Offset()", function (e) {
                var t = this.context;
                return e === v
                    ? t.length && t[0]._fixedHeader
                        ? t[0]._fixedHeader[o + "Offset"]()
                        : v
                    : this.iterator("table", function (t) {
                          t = t._fixedHeader;
                          t && t[o + "Offset"](e);
                      });
            });
        }),
        n
    );
});

/*! Bulma styling wrapper for FixedHeader
 * © SpryMedia Ltd - datatables.net/license
 */
!(function (t) {
    var d, a;
    "function" == typeof define && define.amd
        ? define(
              ["jquery", "datatables.net-bm", "datatables.net-fixedheader"],
              function (e) {
                  return t(e, window, document);
              }
          )
        : "object" == typeof exports
        ? ((d = require("jquery")),
          (a = function (e, n) {
              n.fn.dataTable || require("datatables.net-bm")(e, n),
                  n.fn.dataTable.FixedHeader ||
                      require("datatables.net-fixedheader")(e, n);
          }),
          "undefined" == typeof window
              ? (module.exports = function (e, n) {
                    return (
                        (e = e || window),
                        (n = n || d(e)),
                        a(e, n),
                        t(n, 0, e.document)
                    );
                })
              : (a(window, d),
                (module.exports = t(d, window, window.document))))
        : t(jQuery, window, document);
})(function (e, n, t, d) {
    "use strict";
    return e.fn.dataTable;
});

/*! Responsive 2.5.0
 * © SpryMedia Ltd - datatables.net/license
 */
!(function (n) {
    var i, r;
    "function" == typeof define && define.amd
        ? define(["jquery", "datatables.net"], function (e) {
              return n(e, window, document);
          })
        : "object" == typeof exports
        ? ((i = require("jquery")),
          (r = function (e, t) {
              t.fn.dataTable || require("datatables.net")(e, t);
          }),
          "undefined" == typeof window
              ? (module.exports = function (e, t) {
                    return (
                        (e = e || window),
                        (t = t || i(e)),
                        r(e, t),
                        n(t, e, e.document)
                    );
                })
              : (r(window, i),
                (module.exports = n(i, window, window.document))))
        : n(jQuery, window, document);
})(function (f, m, d, h) {
    "use strict";
    function a(e, t) {
        if (!r.versionCheck || !r.versionCheck("1.10.10"))
            throw "DataTables Responsive requires DataTables 1.10.10 or newer";
        (this.s = {
            childNodeStore: {},
            columns: [],
            current: [],
            dt: new r.Api(e),
        }),
            this.s.dt.settings()[0].responsive ||
                (t && "string" == typeof t.details
                    ? (t.details = { type: t.details })
                    : t && !1 === t.details
                    ? (t.details = { type: !1 })
                    : t && !0 === t.details && (t.details = { type: "inline" }),
                (this.c = f.extend(
                    !0,
                    {},
                    a.defaults,
                    r.defaults.responsive,
                    t
                )),
                (e.responsive = this)._constructor());
    }
    var r = f.fn.dataTable,
        e =
            (f.extend(a.prototype, {
                _constructor: function () {
                    var s = this,
                        i = this.s.dt,
                        e = i.settings()[0],
                        t = f(m).innerWidth(),
                        e =
                            ((i.settings()[0]._responsive = this),
                            f(m).on(
                                "resize.dtr orientationchange.dtr",
                                r.util.throttle(function () {
                                    var e = f(m).innerWidth();
                                    e !== t && (s._resize(), (t = e));
                                })
                            ),
                            e.oApi._fnCallbackReg(
                                e,
                                "aoRowCreatedCallback",
                                function (e, t, n) {
                                    -1 !== f.inArray(!1, s.s.current) &&
                                        f(">td, >th", e).each(function (e) {
                                            e = i.column.index("toData", e);
                                            !1 === s.s.current[e] &&
                                                f(this).css("display", "none");
                                        });
                                }
                            ),
                            i.on("destroy.dtr", function () {
                                i.off(".dtr"),
                                    f(i.table().body()).off(".dtr"),
                                    f(m).off(
                                        "resize.dtr orientationchange.dtr"
                                    ),
                                    i
                                        .cells(".dtr-control")
                                        .nodes()
                                        .to$()
                                        .removeClass("dtr-control"),
                                    f.each(s.s.current, function (e, t) {
                                        !1 === t && s._setColumnVis(e, !0);
                                    });
                            }),
                            this.c.breakpoints.sort(function (e, t) {
                                return e.width < t.width
                                    ? 1
                                    : e.width > t.width
                                    ? -1
                                    : 0;
                            }),
                            this._classLogic(),
                            this._resizeAuto(),
                            this.c.details);
                    !1 !== e.type &&
                        (s._detailsInit(),
                        i.on("column-visibility.dtr", function () {
                            s._timer && clearTimeout(s._timer),
                                (s._timer = setTimeout(function () {
                                    (s._timer = null),
                                        s._classLogic(),
                                        s._resizeAuto(),
                                        s._resize(!0),
                                        s._redrawChildren();
                                }, 100));
                        }),
                        i.on("draw.dtr", function () {
                            s._redrawChildren();
                        }),
                        f(i.table().node()).addClass("dtr-" + e.type)),
                        i.on("column-reorder.dtr", function (e, t, n) {
                            s._classLogic(), s._resizeAuto(), s._resize(!0);
                        }),
                        i.on("column-sizing.dtr", function () {
                            s._resizeAuto(), s._resize();
                        }),
                        i.on("column-calc.dt", function (e, t) {
                            for (
                                var n = s.s.current, i = 0;
                                i < n.length;
                                i++
                            ) {
                                var r = t.visible.indexOf(i);
                                !1 === n[i] && 0 <= r && t.visible.splice(r, 1);
                            }
                        }),
                        i.on("preXhr.dtr", function () {
                            var e = [];
                            i.rows().every(function () {
                                this.child.isShown() && e.push(this.id(!0));
                            }),
                                i.one("draw.dtr", function () {
                                    s._resizeAuto(),
                                        s._resize(),
                                        i.rows(e).every(function () {
                                            s._detailsDisplay(this, !1);
                                        });
                                });
                        }),
                        i
                            .on("draw.dtr", function () {
                                s._controlClass();
                            })
                            .on("init.dtr", function (e, t, n) {
                                "dt" === e.namespace &&
                                    (s._resizeAuto(),
                                    s._resize(),
                                    f.inArray(!1, s.s.current)) &&
                                    i.columns.adjust();
                            }),
                        this._resize();
                },
                _childNodes: function (e, t, n) {
                    var i = t + "-" + n;
                    if (this.s.childNodeStore[i])
                        return this.s.childNodeStore[i];
                    for (
                        var r = [],
                            s = e.cell(t, n).node().childNodes,
                            o = 0,
                            d = s.length;
                        o < d;
                        o++
                    )
                        r.push(s[o]);
                    return (this.s.childNodeStore[i] = r);
                },
                _childNodesRestore: function (e, t, n) {
                    var i = t + "-" + n;
                    if (this.s.childNodeStore[i]) {
                        for (
                            var r = e.cell(t, n).node(),
                                s =
                                    this.s.childNodeStore[i][0].parentNode
                                        .childNodes,
                                o = [],
                                d = 0,
                                a = s.length;
                            d < a;
                            d++
                        )
                            o.push(s[d]);
                        for (var l = 0, c = o.length; l < c; l++)
                            r.appendChild(o[l]);
                        this.s.childNodeStore[i] = h;
                    }
                },
                _columnsVisiblity: function (n) {
                    for (
                        var i = this.s.dt,
                            e = this.s.columns,
                            t = e
                                .map(function (e, t) {
                                    return {
                                        columnIdx: t,
                                        priority: e.priority,
                                    };
                                })
                                .sort(function (e, t) {
                                    return e.priority !== t.priority
                                        ? e.priority - t.priority
                                        : e.columnIdx - t.columnIdx;
                                }),
                            r = f.map(e, function (e, t) {
                                return !1 === i.column(t).visible()
                                    ? "not-visible"
                                    : (!e.auto || null !== e.minWidth) &&
                                          (!0 === e.auto
                                              ? "-"
                                              : -1 !==
                                                f.inArray(n, e.includeIn));
                            }),
                            s = 0,
                            o = 0,
                            d = r.length;
                        o < d;
                        o++
                    )
                        !0 === r[o] && (s += e[o].minWidth);
                    var a = i.settings()[0].oScroll,
                        a = a.sY || a.sX ? a.iBarWidth : 0,
                        l = i.table().container().offsetWidth - a - s;
                    for (o = 0, d = r.length; o < d; o++)
                        e[o].control && (l -= e[o].minWidth);
                    var c = !1;
                    for (o = 0, d = t.length; o < d; o++) {
                        var u = t[o].columnIdx;
                        "-" === r[u] &&
                            !e[u].control &&
                            e[u].minWidth &&
                            (c || l - e[u].minWidth < 0
                                ? (r[u] = !(c = !0))
                                : (r[u] = !0),
                            (l -= e[u].minWidth));
                    }
                    var h = !1;
                    for (o = 0, d = e.length; o < d; o++)
                        if (!e[o].control && !e[o].never && !1 === r[o]) {
                            h = !0;
                            break;
                        }
                    for (o = 0, d = e.length; o < d; o++)
                        e[o].control && (r[o] = h),
                            "not-visible" === r[o] && (r[o] = !1);
                    return -1 === f.inArray(!0, r) && (r[0] = !0), r;
                },
                _classLogic: function () {
                    function d(e, t, n, i) {
                        var r, s, o;
                        if (n) {
                            if ("max-" === n)
                                for (
                                    r = a._find(t).width, s = 0, o = l.length;
                                    s < o;
                                    s++
                                )
                                    l[s].width <= r && u(e, l[s].name);
                            else if ("min-" === n)
                                for (
                                    r = a._find(t).width, s = 0, o = l.length;
                                    s < o;
                                    s++
                                )
                                    l[s].width >= r && u(e, l[s].name);
                            else if ("not-" === n)
                                for (s = 0, o = l.length; s < o; s++)
                                    -1 === l[s].name.indexOf(i) &&
                                        u(e, l[s].name);
                        } else c[e].includeIn.push(t);
                    }
                    var a = this,
                        l = this.c.breakpoints,
                        i = this.s.dt,
                        c = i
                            .columns()
                            .eq(0)
                            .map(function (e) {
                                var t = this.column(e),
                                    n = t.header().className,
                                    e =
                                        i.settings()[0].aoColumns[e]
                                            .responsivePriority,
                                    t = t
                                        .header()
                                        .getAttribute("data-priority");
                                return (
                                    e === h &&
                                        (e = t === h || null === t ? 1e4 : +t),
                                    {
                                        className: n,
                                        includeIn: [],
                                        auto: !1,
                                        control: !1,
                                        never: !!n.match(/\b(dtr\-)?never\b/),
                                        priority: e,
                                    }
                                );
                            }),
                        u = function (e, t) {
                            e = c[e].includeIn;
                            -1 === f.inArray(t, e) && e.push(t);
                        };
                    c.each(function (e, r) {
                        for (
                            var t = e.className.split(" "),
                                s = !1,
                                n = 0,
                                i = t.length;
                            n < i;
                            n++
                        ) {
                            var o = t[n].trim();
                            if ("all" === o || "dtr-all" === o)
                                return (
                                    (s = !0),
                                    void (e.includeIn = f.map(l, function (e) {
                                        return e.name;
                                    }))
                                );
                            if ("none" === o || "dtr-none" === o || e.never)
                                return void (s = !0);
                            if ("control" === o || "dtr-control" === o)
                                return (s = !0), void (e.control = !0);
                            f.each(l, function (e, t) {
                                var n = t.name.split("-"),
                                    i = new RegExp(
                                        "(min\\-|max\\-|not\\-)?(" +
                                            n[0] +
                                            ")(\\-[_a-zA-Z0-9])?"
                                    ),
                                    i = o.match(i);
                                i &&
                                    ((s = !0),
                                    i[2] === n[0] && i[3] === "-" + n[1]
                                        ? d(r, t.name, i[1], i[2] + i[3])
                                        : i[2] !== n[0] ||
                                          i[3] ||
                                          d(r, t.name, i[1], i[2]));
                            });
                        }
                        s || (e.auto = !0);
                    }),
                        (this.s.columns = c);
                },
                _controlClass: function () {
                    var e, t, n;
                    "inline" === this.c.details.type &&
                        ((e = this.s.dt),
                        (t = this.s.current),
                        (n = f.inArray(!0, t)),
                        e
                            .cells(
                                null,
                                function (e) {
                                    return e !== n;
                                },
                                { page: "current" }
                            )
                            .nodes()
                            .to$()
                            .filter(".dtr-control")
                            .removeClass("dtr-control"),
                        e
                            .cells(null, n, { page: "current" })
                            .nodes()
                            .to$()
                            .addClass("dtr-control"));
                },
                _detailsDisplay: function (t, n) {
                    function e(e) {
                        f(t.node()).toggleClass("parent", !1 !== e),
                            f(s.table().node()).triggerHandler(
                                "responsive-display.dt",
                                [s, t, e, n]
                            );
                    }
                    var i,
                        r = this,
                        s = this.s.dt,
                        o = this.c.details;
                    o &&
                        !1 !== o.type &&
                        ((i =
                            "string" == typeof o.renderer
                                ? a.renderer[o.renderer]()
                                : o.renderer),
                        "boolean" ==
                            typeof (o = o.display(
                                t,
                                n,
                                function () {
                                    return i.call(
                                        r,
                                        s,
                                        t[0],
                                        r._detailsObj(t[0])
                                    );
                                },
                                function () {
                                    e(!1);
                                }
                            ))) &&
                        e(o);
                },
                _detailsInit: function () {
                    var n = this,
                        i = this.s.dt,
                        e = this.c.details,
                        r =
                            ("inline" === e.type &&
                                (e.target = "td.dtr-control, th.dtr-control"),
                            i.on("draw.dtr", function () {
                                n._tabIndexes();
                            }),
                            n._tabIndexes(),
                            f(i.table().body()).on(
                                "keyup.dtr",
                                "td, th",
                                function (e) {
                                    13 === e.keyCode &&
                                        f(this).data("dtr-keyboard") &&
                                        f(this).click();
                                }
                            ),
                            e.target),
                        e = "string" == typeof r ? r : "td, th";
                    (r === h && null === r) ||
                        f(i.table().body()).on(
                            "click.dtr mousedown.dtr mouseup.dtr",
                            e,
                            function (e) {
                                if (
                                    f(i.table().node()).hasClass("collapsed") &&
                                    -1 !==
                                        f.inArray(
                                            f(this).closest("tr").get(0),
                                            i.rows().nodes().toArray()
                                        )
                                ) {
                                    if ("number" == typeof r) {
                                        var t =
                                            r < 0
                                                ? i.columns().eq(0).length + r
                                                : r;
                                        if (i.cell(this).index().column !== t)
                                            return;
                                    }
                                    t = i.row(f(this).closest("tr"));
                                    "click" === e.type
                                        ? n._detailsDisplay(t, !1)
                                        : "mousedown" === e.type
                                        ? f(this).css("outline", "none")
                                        : "mouseup" === e.type &&
                                          f(this)
                                              .trigger("blur")
                                              .css("outline", "");
                                }
                            }
                        );
                },
                _detailsObj: function (n) {
                    var i = this,
                        r = this.s.dt;
                    return f.map(this.s.columns, function (e, t) {
                        if (!e.never && !e.control)
                            return {
                                className: (e = r.settings()[0].aoColumns[t])
                                    .sClass,
                                columnIndex: t,
                                data: r.cell(n, t).render(i.c.orthogonal),
                                hidden:
                                    r.column(t).visible() && !i.s.current[t],
                                rowIndex: n,
                                title:
                                    null !== e.sTitle
                                        ? e.sTitle
                                        : f(r.column(t).header()).text(),
                            };
                    });
                },
                _find: function (e) {
                    for (
                        var t = this.c.breakpoints, n = 0, i = t.length;
                        n < i;
                        n++
                    )
                        if (t[n].name === e) return t[n];
                },
                _redrawChildren: function () {
                    var n = this,
                        i = this.s.dt;
                    i.rows({ page: "current" }).iterator(
                        "row",
                        function (e, t) {
                            n._detailsDisplay(i.row(t), !0);
                        }
                    );
                },
                _resize: function (n) {
                    for (
                        var e,
                            i = this,
                            t = this.s.dt,
                            r = f(m).innerWidth(),
                            s = this.c.breakpoints,
                            o = s[0].name,
                            d = this.s.columns,
                            a = this.s.current.slice(),
                            l = s.length - 1;
                        0 <= l;
                        l--
                    )
                        if (r <= s[l].width) {
                            o = s[l].name;
                            break;
                        }
                    var c = this._columnsVisiblity(o),
                        u = ((this.s.current = c), !1);
                    for (l = 0, e = d.length; l < e; l++)
                        if (
                            !1 === c[l] &&
                            !d[l].never &&
                            !d[l].control &&
                            !1 == !t.column(l).visible()
                        ) {
                            u = !0;
                            break;
                        }
                    f(t.table().node()).toggleClass("collapsed", u);
                    var h = !1,
                        p = 0;
                    t
                        .columns()
                        .eq(0)
                        .each(function (e, t) {
                            !0 === c[t] && p++,
                                (!n && c[t] === a[t]) ||
                                    ((h = !0), i._setColumnVis(e, c[t]));
                        }),
                        this._redrawChildren(),
                        h &&
                            (f(t.table().node()).trigger(
                                "responsive-resize.dt",
                                [t, this.s.current]
                            ),
                            0 === t.page.info().recordsDisplay) &&
                            f("td", t.table().body()).eq(0).attr("colspan", p),
                        i._controlClass();
                },
                _resizeAuto: function () {
                    var e,
                        t,
                        n,
                        i,
                        r,
                        s = this.s.dt,
                        o = this.s.columns,
                        d = this;
                    this.c.auto &&
                        -1 !==
                            f.inArray(
                                !0,
                                f.map(o, function (e) {
                                    return e.auto;
                                })
                            ) &&
                        (f.isEmptyObject(this.s.childNodeStore) ||
                            f.each(this.s.childNodeStore, function (e) {
                                e = e.split("-");
                                d._childNodesRestore(s, +e[0], +e[1]);
                            }),
                        s.table().node().offsetWidth,
                        s.columns,
                        (e = s.table().node().cloneNode(!1)),
                        (t = f(s.table().header().cloneNode(!1)).appendTo(e)),
                        (i = f(s.table().body())
                            .clone(!1, !1)
                            .empty()
                            .appendTo(e)),
                        (e.style.width = "auto"),
                        (n = s
                            .columns()
                            .header()
                            .filter(function (e) {
                                return s.column(e).visible();
                            })
                            .to$()
                            .clone(!1)
                            .css("display", "table-cell")
                            .css("width", "auto")
                            .css("min-width", 0)),
                        f(i)
                            .append(
                                f(s.rows({ page: "current" }).nodes()).clone(!1)
                            )
                            .find("th, td")
                            .css("display", ""),
                        (i = s.table().footer()) &&
                            ((i = f(i.cloneNode(!1)).appendTo(e)),
                            (r = s
                                .columns()
                                .footer()
                                .filter(function (e) {
                                    return s.column(e).visible();
                                })
                                .to$()
                                .clone(!1)
                                .css("display", "table-cell")),
                            f("<tr/>").append(r).appendTo(i)),
                        f("<tr/>").append(n).appendTo(t),
                        "inline" === this.c.details.type &&
                            f(e).addClass("dtr-inline collapsed"),
                        f(e).find("[name]").removeAttr("name"),
                        f(e).css("position", "relative"),
                        (r = f("<div/>")
                            .css({
                                width: 1,
                                height: 1,
                                overflow: "hidden",
                                clear: "both",
                            })
                            .append(e)).insertBefore(s.table().node()),
                        n.each(function (e) {
                            e = s.column.index("fromVisible", e);
                            o[e].minWidth = this.offsetWidth || 0;
                        }),
                        r.remove());
                },
                _responsiveOnlyHidden: function () {
                    var n = this.s.dt;
                    return f.map(this.s.current, function (e, t) {
                        return !1 === n.column(t).visible() || e;
                    });
                },
                _setColumnVis: function (e, t) {
                    var n = this,
                        i = this.s.dt,
                        r = t ? "" : "none";
                    f(i.column(e).header())
                        .css("display", r)
                        .toggleClass("dtr-hidden", !t),
                        f(i.column(e).footer())
                            .css("display", r)
                            .toggleClass("dtr-hidden", !t),
                        i
                            .column(e)
                            .nodes()
                            .to$()
                            .css("display", r)
                            .toggleClass("dtr-hidden", !t),
                        f.isEmptyObject(this.s.childNodeStore) ||
                            i
                                .cells(null, e)
                                .indexes()
                                .each(function (e) {
                                    n._childNodesRestore(i, e.row, e.column);
                                });
                },
                _tabIndexes: function () {
                    var e = this.s.dt,
                        t = e.cells({ page: "current" }).nodes().to$(),
                        n = e.settings()[0],
                        i = this.c.details.target;
                    t
                        .filter("[data-dtr-keyboard]")
                        .removeData("[data-dtr-keyboard]"),
                        ("number" == typeof i
                            ? e
                                  .cells(null, i, { page: "current" })
                                  .nodes()
                                  .to$()
                            : f(
                                  (i =
                                      "td:first-child, th:first-child" === i
                                          ? ">td:first-child, >th:first-child"
                                          : i),
                                  e.rows({ page: "current" }).nodes()
                              )
                        )
                            .attr("tabIndex", n.iTabIndex)
                            .data("dtr-keyboard", 1);
                },
            }),
            (a.defaults = {
                breakpoints: (a.breakpoints = [
                    { name: "desktop", width: 1 / 0 },
                    { name: "tablet-l", width: 1024 },
                    { name: "tablet-p", width: 768 },
                    { name: "mobile-l", width: 480 },
                    { name: "mobile-p", width: 320 },
                ]),
                auto: !0,
                details: {
                    display: (a.display = {
                        childRow: function (e, t, n) {
                            return t
                                ? f(e.node()).hasClass("parent")
                                    ? (e.child(n(), "child").show(), !0)
                                    : void 0
                                : e.child.isShown()
                                ? (e.child(!1), !1)
                                : (e.child(n(), "child").show(), !0);
                        },
                        childRowImmediate: function (e, t, n) {
                            return (!t && e.child.isShown()) ||
                                !e.responsive.hasHidden()
                                ? (e.child(!1), !1)
                                : (e.child(n(), "child").show(), !0);
                        },
                        modal: function (o) {
                            return function (e, t, n, i) {
                                if (t) {
                                    if (
                                        !(s = f("div.dtr-modal-content"))
                                            .length ||
                                        e.index() !== s.data("dtr-row-idx")
                                    )
                                        return null;
                                    s.empty().append(n());
                                } else {
                                    var r = function () {
                                            s.remove(),
                                                f(d).off("keypress.dtr"),
                                                f(e.node()).removeClass(
                                                    "parent"
                                                ),
                                                i();
                                        },
                                        s = f('<div class="dtr-modal"/>')
                                            .append(
                                                f(
                                                    '<div class="dtr-modal-display"/>'
                                                )
                                                    .append(
                                                        f(
                                                            '<div class="dtr-modal-content"/>'
                                                        )
                                                            .data(
                                                                "dtr-row-idx",
                                                                e.index()
                                                            )
                                                            .append(n())
                                                    )
                                                    .append(
                                                        f(
                                                            '<div class="dtr-modal-close">&times;</div>'
                                                        ).click(function () {
                                                            r();
                                                        })
                                                    )
                                            )
                                            .append(
                                                f(
                                                    '<div class="dtr-modal-background"/>'
                                                ).click(function () {
                                                    r();
                                                })
                                            )
                                            .appendTo("body");
                                    f(e.node()).addClass("parent"),
                                        f(d).on("keyup.dtr", function (e) {
                                            27 === e.keyCode &&
                                                (e.stopPropagation(), r());
                                        });
                                }
                                return (
                                    o &&
                                        o.header &&
                                        f("div.dtr-modal-content").prepend(
                                            "<h2>" + o.header(e) + "</h2>"
                                        ),
                                    !0
                                );
                            };
                        },
                    }).childRow,
                    renderer: (a.renderer = {
                        listHiddenNodes: function () {
                            return function (i, e, t) {
                                var r = this,
                                    s = f(
                                        '<ul data-dtr-index="' +
                                            e +
                                            '" class="dtr-details"/>'
                                    ),
                                    o = !1;
                                f.each(t, function (e, t) {
                                    var n;
                                    t.hidden &&
                                        ((n = t.className
                                            ? 'class="' + t.className + '"'
                                            : ""),
                                        f(
                                            "<li " +
                                                n +
                                                ' data-dtr-index="' +
                                                t.columnIndex +
                                                '" data-dt-row="' +
                                                t.rowIndex +
                                                '" data-dt-column="' +
                                                t.columnIndex +
                                                '"><span class="dtr-title">' +
                                                t.title +
                                                "</span> </li>"
                                        )
                                            .append(
                                                f(
                                                    '<span class="dtr-data"/>'
                                                ).append(
                                                    r._childNodes(
                                                        i,
                                                        t.rowIndex,
                                                        t.columnIndex
                                                    )
                                                )
                                            )
                                            .appendTo(s),
                                        (o = !0));
                                });
                                return !!o && s;
                            };
                        },
                        listHidden: function () {
                            return function (e, t, n) {
                                n = f
                                    .map(n, function (e) {
                                        var t = e.className
                                            ? 'class="' + e.className + '"'
                                            : "";
                                        return e.hidden
                                            ? "<li " +
                                                  t +
                                                  ' data-dtr-index="' +
                                                  e.columnIndex +
                                                  '" data-dt-row="' +
                                                  e.rowIndex +
                                                  '" data-dt-column="' +
                                                  e.columnIndex +
                                                  '"><span class="dtr-title">' +
                                                  e.title +
                                                  '</span> <span class="dtr-data">' +
                                                  e.data +
                                                  "</span></li>"
                                            : "";
                                    })
                                    .join("");
                                return (
                                    !!n &&
                                    f(
                                        '<ul data-dtr-index="' +
                                            t +
                                            '" class="dtr-details"/>'
                                    ).append(n)
                                );
                            };
                        },
                        tableAll: function (i) {
                            return (
                                (i = f.extend({ tableClass: "" }, i)),
                                function (e, t, n) {
                                    n = f
                                        .map(n, function (e) {
                                            return (
                                                "<tr " +
                                                (e.className
                                                    ? 'class="' +
                                                      e.className +
                                                      '"'
                                                    : "") +
                                                ' data-dt-row="' +
                                                e.rowIndex +
                                                '" data-dt-column="' +
                                                e.columnIndex +
                                                '"><td>' +
                                                e.title +
                                                ":</td> <td>" +
                                                e.data +
                                                "</td></tr>"
                                            );
                                        })
                                        .join("");
                                    return f(
                                        '<table class="' +
                                            i.tableClass +
                                            ' dtr-details" width="100%"/>'
                                    ).append(n);
                                }
                            );
                        },
                    }).listHidden(),
                    target: 0,
                    type: "inline",
                },
                orthogonal: "display",
            }),
            f.fn.dataTable.Api);
    return (
        e.register("responsive()", function () {
            return this;
        }),
        e.register("responsive.index()", function (e) {
            return {
                column: (e = f(e)).data("dtr-index"),
                row: e.parent().data("dtr-index"),
            };
        }),
        e.register("responsive.rebuild()", function () {
            return this.iterator("table", function (e) {
                e._responsive && e._responsive._classLogic();
            });
        }),
        e.register("responsive.recalc()", function () {
            return this.iterator("table", function (e) {
                e._responsive &&
                    (e._responsive._resizeAuto(), e._responsive._resize());
            });
        }),
        e.register("responsive.hasHidden()", function () {
            var e = this.context[0];
            return (
                !!e._responsive &&
                -1 !== f.inArray(!1, e._responsive._responsiveOnlyHidden())
            );
        }),
        e.registerPlural(
            "columns().responsiveHidden()",
            "column().responsiveHidden()",
            function () {
                return this.iterator(
                    "column",
                    function (e, t) {
                        return (
                            !!e._responsive &&
                            e._responsive._responsiveOnlyHidden()[t]
                        );
                    },
                    1
                );
            }
        ),
        (a.version = "2.5.0"),
        (f.fn.dataTable.Responsive = a),
        (f.fn.DataTable.Responsive = a),
        f(d).on("preInit.dt.dtr", function (e, t, n) {
            "dt" === e.namespace &&
                (f(t.nTable).hasClass("responsive") ||
                    f(t.nTable).hasClass("dt-responsive") ||
                    t.oInit.responsive ||
                    r.defaults.responsive) &&
                !1 !== (e = t.oInit.responsive) &&
                new a(t, f.isPlainObject(e) ? e : {});
        }),
        r
    );
});

/*! Bulma integration for DataTables' Responsive
 * © SpryMedia Ltd - datatables.net/license
 */
!(function (a) {
    var n, t;
    "function" == typeof define && define.amd
        ? define(
              ["jquery", "datatables.net-bm", "datatables.net-responsive"],
              function (e) {
                  return a(e, window, document);
              }
          )
        : "object" == typeof exports
        ? ((n = require("jquery")),
          (t = function (e, d) {
              d.fn.dataTable || require("datatables.net-bm")(e, d),
                  d.fn.dataTable.Responsive ||
                      require("datatables.net-responsive")(e, d);
          }),
          "undefined" == typeof window
              ? (module.exports = function (e, d) {
                    return (
                        (e = e || window),
                        (d = d || n(e)),
                        t(e, d),
                        a(d, 0, e.document)
                    );
                })
              : (t(window, n),
                (module.exports = a(n, window, window.document))))
        : a(jQuery, window, document);
})(function (o, e, i, d) {
    "use strict";
    var a = o.fn.dataTable,
        n = a.Responsive.display,
        s =
            (n.modal,
            o(
                '<div class="modal DTED"><div class="modal-background"></div><div class="modal-content"><div class="modal-header"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"/></div><button class="modal-close is-large" aria-label="close"></button></div>'
            ));
    return (
        (n.modal = function (t) {
            return function (e, d, a, n) {
                if (d) {
                    if (
                        !o.contains(i, s[0]) ||
                        e.index() !== s.data("dtr-row-idx")
                    )
                        return null;
                    s.find("div.modal-body").empty().append(a());
                } else
                    t &&
                        t.header &&
                        ((d = s.find("div.modal-header"))
                            .find("button")
                            .detach(),
                        d
                            .empty()
                            .append(
                                '<h4 class="modal-title subtitle">' +
                                    t.header(e) +
                                    "</h4>"
                            )),
                        s.find("div.modal-body").empty().append(a()),
                        s.data("dtr-row-idx", e.index()).appendTo("body"),
                        s.addClass("is-active is-clipped"),
                        o(".modal-close").one("click", function () {
                            s.removeClass("is-active is-clipped"), n();
                        }),
                        o(".modal-background").one("click", function () {
                            s.removeClass("is-active is-clipped"), n();
                        });
                return !0;
            };
        }),
        a
    );
});

/*! Scroller 2.2.0
 * © SpryMedia Ltd - datatables.net/license
 */
!(function (o) {
    var e, l;
    "function" == typeof define && define.amd
        ? define(["jquery", "datatables.net"], function (s) {
              return o(s, window, document);
          })
        : "object" == typeof exports
        ? ((e = require("jquery")),
          (l = function (s, t) {
              t.fn.dataTable || require("datatables.net")(s, t);
          }),
          "undefined" == typeof window
              ? (module.exports = function (s, t) {
                    return (
                        (s = s || window),
                        (t = t || e(s)),
                        l(s, t),
                        o(t, s, s.document)
                    );
                })
              : (l(window, e),
                (module.exports = o(e, window, window.document))))
        : o(jQuery, window, document);
})(function (f, i, o, a) {
    "use strict";
    function l(s, t) {
        this instanceof l
            ? (t === a && (t = {}),
              (s = f.fn.dataTable.Api(s)),
              (this.s = {
                  dt: s.settings()[0],
                  dtApi: s,
                  tableTop: 0,
                  tableBottom: 0,
                  redrawTop: 0,
                  redrawBottom: 0,
                  autoHeight: !0,
                  viewportRows: 0,
                  stateTO: null,
                  stateSaveThrottle: function () {},
                  drawTO: null,
                  heights: {
                      jump: null,
                      page: null,
                      virtual: null,
                      scroll: null,
                      row: null,
                      viewport: null,
                      labelHeight: 0,
                      xbar: 0,
                  },
                  topRowFloat: 0,
                  scrollDrawDiff: null,
                  loaderVisible: !1,
                  forceReposition: !1,
                  baseRowTop: 0,
                  baseScrollTop: 0,
                  mousedown: !1,
                  lastScrollTop: 0,
              }),
              (this.s = f.extend(this.s, l.oDefaults, t)),
              (this.s.heights.row = this.s.rowHeight),
              (this.dom = {
                  force: o.createElement("div"),
                  label: f('<div class="dts_label">0</div>'),
                  scroller: null,
                  table: null,
                  loader: null,
              }),
              this.s.dt.oScroller || (this.s.dt.oScroller = this).construct())
            : alert(
                  "Scroller warning: Scroller must be initialised with the 'new' keyword."
              );
    }
    var r = f.fn.dataTable,
        s =
            (f.extend(l.prototype, {
                measure: function (s) {
                    this.s.autoHeight && this._calcRowHeight();
                    var t = this.s.heights,
                        o =
                            (t.row &&
                                ((t.viewport = this._parseHeight(
                                    f(this.dom.scroller).css("max-height")
                                )),
                                (this.s.viewportRows =
                                    parseInt(t.viewport / t.row, 10) + 1),
                                (this.s.dt._iDisplayLength =
                                    this.s.viewportRows *
                                    this.s.displayBuffer)),
                            this.dom.label.outerHeight());
                    (t.xbar =
                        this.dom.scroller.offsetHeight -
                        this.dom.scroller.clientHeight),
                        (t.labelHeight = o),
                        (s !== a && !s) || this.s.dt.oInstance.fnDraw(!1);
                },
                pageInfo: function () {
                    var s = this.s.dt,
                        t = this.dom.scroller.scrollTop,
                        s = s.fnRecordsDisplay(),
                        o = Math.ceil(
                            this.pixelsToRow(
                                t + this.s.heights.viewport,
                                !1,
                                this.s.ani
                            )
                        );
                    return {
                        start: Math.floor(this.pixelsToRow(t, !1, this.s.ani)),
                        end: s < o ? s - 1 : o - 1,
                    };
                },
                pixelsToRow: function (s, t, o) {
                    (s -= this.s.baseScrollTop),
                        (o = o
                            ? (this._domain(
                                  "physicalToVirtual",
                                  this.s.baseScrollTop
                              ) +
                                  s) /
                              this.s.heights.row
                            : s / this.s.heights.row + this.s.baseRowTop);
                    return t || t === a ? parseInt(o, 10) : o;
                },
                rowToPixels: function (s, t, o) {
                    (s -= this.s.baseRowTop),
                        (o = o
                            ? this._domain(
                                  "virtualToPhysical",
                                  this.s.baseScrollTop
                              )
                            : this.s.baseScrollTop);
                    return (
                        (o += s * this.s.heights.row),
                        t || t === a ? parseInt(o, 10) : o
                    );
                },
                scrollToRow: function (s, t) {
                    var o = this,
                        e = !1,
                        l = this.rowToPixels(s),
                        r =
                            s -
                            ((this.s.displayBuffer - 1) / 2) *
                                this.s.viewportRows;
                    r < 0 && (r = 0),
                        (t =
                            (l > this.s.redrawBottom || l < this.s.redrawTop) &&
                            this.s.dt._iDisplayStart !== r &&
                            ((e = !0),
                            (l = this._domain(
                                "virtualToPhysical",
                                s * this.s.heights.row
                            )),
                            this.s.redrawTop < l) &&
                            l < this.s.redrawBottom
                                ? !(this.s.forceReposition = !0)
                                : t) === a || t
                            ? ((this.s.ani = e),
                              f(this.dom.scroller).animate(
                                  { scrollTop: l },
                                  function () {
                                      setTimeout(function () {
                                          o.s.ani = !1;
                                      }, 250);
                                  }
                              ))
                            : f(this.dom.scroller).scrollTop(l);
                },
                construct: function () {
                    var e,
                        l,
                        r = this,
                        s = this.s.dtApi;
                    this.s.dt.oFeatures.bPaginate
                        ? ((this.dom.force.style.position = "relative"),
                          (this.dom.force.style.top = "0px"),
                          (this.dom.force.style.left = "0px"),
                          (this.dom.force.style.width = "1px"),
                          (this.dom.scroller = f(
                              "div." + this.s.dt.oClasses.sScrollBody,
                              this.s.dt.nTableWrapper
                          )[0]),
                          this.dom.scroller.appendChild(this.dom.force),
                          (this.dom.scroller.style.position = "relative"),
                          (this.dom.table = f(">table", this.dom.scroller)[0]),
                          (this.dom.table.style.position = "absolute"),
                          (this.dom.table.style.top = "0px"),
                          (this.dom.table.style.left = "0px"),
                          f(s.table().container()).addClass("dts DTS"),
                          this.s.loadingIndicator &&
                              ((this.dom.loader = f(
                                  '<div class="dataTables_processing dts_loading">' +
                                      this.s.dt.oLanguage.sLoadingRecords +
                                      "</div>"
                              ).css("display", "none")),
                              f(this.dom.scroller.parentNode)
                                  .css("position", "relative")
                                  .append(this.dom.loader)),
                          this.dom.label.appendTo(this.dom.scroller),
                          this.s.heights.row &&
                              "auto" != this.s.heights.row &&
                              (this.s.autoHeight = !1),
                          (this.s.ingnoreScroll = !0),
                          f(this.dom.scroller).on(
                              "scroll.dt-scroller",
                              function (s) {
                                  r._scroll.call(r);
                              }
                          ),
                          f(this.dom.scroller).on(
                              "touchstart.dt-scroller",
                              function () {
                                  r._scroll.call(r);
                              }
                          ),
                          f(this.dom.scroller)
                              .on("mousedown.dt-scroller", function () {
                                  r.s.mousedown = !0;
                              })
                              .on("mouseup.dt-scroller", function () {
                                  (r.s.labelVisible = !1),
                                      (r.s.mousedown = !1),
                                      r.dom.label.css("display", "none");
                              }),
                          f(i).on("resize.dt-scroller", function () {
                              r.measure(!1), r._info();
                          }),
                          (e = !0),
                          (l = s.state.loaded()),
                          s.on("stateSaveParams.scroller", function (s, t, o) {
                              e && l
                                  ? ((o.scroller = l.scroller),
                                    (e = !1),
                                    o.scroller &&
                                        (r.s.lastScrollTop =
                                            o.scroller.scrollTop))
                                  : (o.scroller = {
                                        topRow: r.s.topRowFloat,
                                        baseScrollTop: r.s.baseScrollTop,
                                        baseRowTop: r.s.baseRowTop,
                                        scrollTop: r.s.lastScrollTop,
                                    });
                          }),
                          s.on("stateLoadParams.scroller", function (s, t, o) {
                              o.scroller !== a &&
                                  r.scrollToRow(o.scroller.topRow);
                          }),
                          l &&
                              l.scroller &&
                              ((this.s.topRowFloat = l.scroller.topRow),
                              (this.s.baseScrollTop = l.scroller.baseScrollTop),
                              (this.s.baseRowTop = l.scroller.baseRowTop)),
                          this.measure(!1),
                          (r.s.stateSaveThrottle = r.s.dt.oApi._fnThrottle(
                              function () {
                                  r.s.dtApi.state.save();
                              },
                              500
                          )),
                          s.on("init.scroller", function () {
                              r.measure(!1),
                                  (r.s.scrollType = "jump"),
                                  r._draw(),
                                  s.on("draw.scroller", function () {
                                      r._draw();
                                  });
                          }),
                          s.on("preDraw.dt.scroller", function () {
                              r._scrollForce();
                          }),
                          s.on("destroy.scroller", function () {
                              f(i).off("resize.dt-scroller"),
                                  f(r.dom.scroller).off(".dt-scroller"),
                                  f(r.s.dt.nTable).off(".scroller"),
                                  f(r.s.dt.nTableWrapper).removeClass("DTS"),
                                  f(
                                      "div.DTS_Loading",
                                      r.dom.scroller.parentNode
                                  ).remove(),
                                  (r.dom.table.style.position = ""),
                                  (r.dom.table.style.top = ""),
                                  (r.dom.table.style.left = "");
                          }))
                        : this.s.dt.oApi._fnLog(
                              this.s.dt,
                              0,
                              "Pagination must be enabled for Scroller"
                          );
                },
                _calcRowHeight: function () {
                    var s = this.s.dt,
                        t = s.nTable,
                        o = t.cloneNode(!1),
                        e = f("<tbody/>").appendTo(o),
                        l = f(
                            '<div class="' +
                                s.oClasses.sWrapper +
                                ' DTS"><div class="' +
                                s.oClasses.sScrollWrapper +
                                '"><div class="' +
                                s.oClasses.sScrollBody +
                                '"></div></div></div>'
                        ),
                        r =
                            (f("tbody tr:lt(4)", t).clone().appendTo(e),
                            f("tr", e).length);
                    if (1 === r)
                        e.prepend("<tr><td>&#160;</td></tr>"),
                            e.append("<tr><td>&#160;</td></tr>");
                    else
                        for (; r < 3; r++) e.append("<tr><td>&#160;</td></tr>");
                    f("div." + s.oClasses.sScrollBody, l).append(o);
                    s = this.s.dt.nHolding || t.parentNode;
                    f(s).is(":visible") || (s = "body"),
                        l.find("input").removeAttr("name"),
                        l.appendTo(s),
                        (this.s.heights.row = f("tr", e).eq(1).outerHeight()),
                        l.remove();
                },
                _draw: function () {
                    var s = this,
                        t = this.s.heights,
                        o = this.dom.scroller.scrollTop,
                        e = f(this.s.dt.nTable).height(),
                        l = this.s.dt._iDisplayStart,
                        r = this.s.dt._iDisplayLength,
                        i = this.s.dt.fnRecordsDisplay(),
                        a = o + t.viewport,
                        n =
                            ((this.s.skip = !0),
                            (!this.s.dt.bSorted && !this.s.dt.bFiltered) ||
                                0 !== l ||
                                this.s.dt._drawHold ||
                                (this.s.topRowFloat = 0),
                            (o =
                                "jump" === this.s.scrollType
                                    ? this._domain(
                                          "virtualToPhysical",
                                          this.s.topRowFloat * t.row
                                      )
                                    : o),
                            (this.s.baseScrollTop = o),
                            (this.s.baseRowTop = this.s.topRowFloat),
                            o - (this.s.topRowFloat - l) * t.row),
                        l =
                            (0 === l
                                ? (n = 0)
                                : i <= l + r
                                ? (n = t.scroll - e)
                                : n + e < a &&
                                  ((this.s.baseScrollTop +=
                                      1 + ((i = a - e) - n)),
                                  (n = i)),
                            (this.dom.table.style.top = n + "px"),
                            (this.s.tableTop = n),
                            (this.s.tableBottom = e + this.s.tableTop),
                            (o - this.s.tableTop) * this.s.boundaryScale);
                    (this.s.redrawTop = o - l),
                        (this.s.redrawBottom =
                            o + l > t.scroll - t.viewport - t.row
                                ? t.scroll - t.viewport - t.row
                                : o + l),
                        (this.s.skip = !1),
                        s.s.ingnoreScroll &&
                            (this.s.dt.oFeatures.bStateSave &&
                            null !== this.s.dt.oLoadedState &&
                            void 0 !== this.s.dt.oLoadedState.scroller
                                ? (((r = !(
                                      (!this.s.dt.sAjaxSource &&
                                          !s.s.dt.ajax) ||
                                      this.s.dt.oFeatures.bServerSide
                                  )) &&
                                      2 <= this.s.dt.iDraw) ||
                                      (!r && 1 <= this.s.dt.iDraw)) &&
                                  setTimeout(function () {
                                      f(s.dom.scroller).scrollTop(
                                          s.s.dt.oLoadedState.scroller.scrollTop
                                      ),
                                          setTimeout(function () {
                                              s.s.ingnoreScroll = !1;
                                          }, 0);
                                  }, 0)
                                : (s.s.ingnoreScroll = !1)),
                        this.s.dt.oFeatures.bInfo &&
                            setTimeout(function () {
                                s._info.call(s);
                            }, 0),
                        f(this.s.dt.nTable).triggerHandler(
                            "position.dts.dt",
                            n
                        ),
                        this.dom.loader &&
                            this.s.loaderVisible &&
                            (this.dom.loader.css("display", "none"),
                            (this.s.loaderVisible = !1));
                },
                _domain: function (s, t) {
                    var o,
                        e = this.s.heights,
                        l = 1e4;
                    return e.virtual === e.scroll || t < l
                        ? t
                        : "virtualToPhysical" === s && t >= e.virtual - l
                        ? ((o = e.virtual - t), e.scroll - o)
                        : "physicalToVirtual" === s && t >= e.scroll - l
                        ? ((o = e.scroll - t), e.virtual - o)
                        : ((e =
                              l -
                              (o = (e.virtual - l - l) / (e.scroll - l - l)) *
                                  l),
                          "virtualToPhysical" === s ? (t - e) / o : o * t + e);
                },
                _info: function () {
                    if (this.s.dt.oFeatures.bInfo) {
                        var s = this.s.dt,
                            t = s.oLanguage,
                            o = this.dom.scroller.scrollTop,
                            e = Math.floor(
                                this.pixelsToRow(o, !1, this.s.ani) + 1
                            ),
                            l = s.fnRecordsTotal(),
                            r = s.fnRecordsDisplay(),
                            o = Math.ceil(
                                this.pixelsToRow(
                                    o + this.s.heights.viewport,
                                    !1,
                                    this.s.ani
                                )
                            ),
                            o = r < o ? r : o,
                            i = s.fnFormatNumber(e),
                            a = s.fnFormatNumber(o),
                            n = s.fnFormatNumber(l),
                            h = s.fnFormatNumber(r),
                            c =
                                0 === s.fnRecordsDisplay() &&
                                s.fnRecordsDisplay() == s.fnRecordsTotal()
                                    ? t.sInfoEmpty + t.sInfoPostFix
                                    : 0 === s.fnRecordsDisplay()
                                    ? t.sInfoEmpty +
                                      " " +
                                      t.sInfoFiltered.replace("_MAX_", n) +
                                      t.sInfoPostFix
                                    : s.fnRecordsDisplay() == s.fnRecordsTotal()
                                    ? t.sInfo
                                          .replace("_START_", i)
                                          .replace("_END_", a)
                                          .replace("_MAX_", n)
                                          .replace("_TOTAL_", h) +
                                      t.sInfoPostFix
                                    : t.sInfo
                                          .replace("_START_", i)
                                          .replace("_END_", a)
                                          .replace("_MAX_", n)
                                          .replace("_TOTAL_", h) +
                                      " " +
                                      t.sInfoFiltered.replace(
                                          "_MAX_",
                                          s.fnFormatNumber(s.fnRecordsTotal())
                                      ) +
                                      t.sInfoPostFix,
                            i = t.fnInfoCallback,
                            d =
                                (i &&
                                    (c = i.call(s.oInstance, s, e, o, l, r, c)),
                                s.aanFeatures.i);
                        if (void 0 !== d)
                            for (var p = 0, u = d.length; p < u; p++)
                                f(d[p]).html(c);
                        f(s.nTable).triggerHandler("info.dt");
                    }
                },
                _parseHeight: function (s) {
                    var t,
                        o,
                        s =
                            /^([+-]?(?:\d+(?:\.\d+)?|\.\d+))(px|em|rem|vh)$/.exec(
                                s
                            );
                    return (
                        (null !== s &&
                            ((o = parseFloat(s[1])),
                            "px" === (s = s[2])
                                ? (t = o)
                                : "vh" === s
                                ? (t = (o / 100) * f(i).height())
                                : "rem" === s
                                ? (t =
                                      o *
                                      parseFloat(f(":root").css("font-size")))
                                : "em" === s &&
                                  (t =
                                      o *
                                      parseFloat(f("body").css("font-size"))),
                            t)) ||
                        0
                    );
                },
                _scroll: function () {
                    var s,
                        t = this,
                        o = this.s.heights,
                        e = this.dom.scroller.scrollTop;
                    this.s.skip ||
                        this.s.ingnoreScroll ||
                        (e !== this.s.lastScrollTop &&
                            (this.s.dt.bFiltered || this.s.dt.bSorted
                                ? (this.s.lastScrollTop = 0)
                                : (this._info(),
                                  clearTimeout(this.s.stateTO),
                                  (this.s.stateTO = setTimeout(function () {
                                      t.s.dtApi.state.save();
                                  }, 250)),
                                  (this.s.scrollType =
                                      Math.abs(e - this.s.lastScrollTop) >
                                      o.viewport
                                          ? "jump"
                                          : "cont"),
                                  (this.s.topRowFloat =
                                      "cont" === this.s.scrollType
                                          ? this.pixelsToRow(e, !1, !1)
                                          : this._domain(
                                                "physicalToVirtual",
                                                e
                                            ) / o.row),
                                  this.s.topRowFloat < 0 &&
                                      (this.s.topRowFloat = 0),
                                  this.s.forceReposition ||
                                  e < this.s.redrawTop ||
                                  e > this.s.redrawBottom
                                      ? ((s = Math.ceil(
                                            ((this.s.displayBuffer - 1) / 2) *
                                                this.s.viewportRows
                                        )),
                                        (s =
                                            parseInt(this.s.topRowFloat, 10) -
                                            s),
                                        (this.s.forceReposition = !1),
                                        s <= 0
                                            ? (s = 0)
                                            : s + this.s.dt._iDisplayLength >
                                              this.s.dt.fnRecordsDisplay()
                                            ? (s =
                                                  this.s.dt.fnRecordsDisplay() -
                                                  this.s.dt._iDisplayLength) <
                                                  0 && (s = 0)
                                            : s % 2 != 0 && s++,
                                        (this.s.targetTop = s) !=
                                            this.s.dt._iDisplayStart &&
                                            ((this.s.tableTop = f(
                                                this.s.dt.nTable
                                            ).offset().top),
                                            (this.s.tableBottom =
                                                f(this.s.dt.nTable).height() +
                                                this.s.tableTop),
                                            (s = function () {
                                                (t.s.dt._iDisplayStart =
                                                    t.s.targetTop),
                                                    t.s.dt.oApi._fnDraw(t.s.dt);
                                            }),
                                            this.s.dt.oFeatures.bServerSide
                                                ? ((this.s.forceReposition =
                                                      !0),
                                                  clearTimeout(this.s.drawTO),
                                                  (this.s.drawTO = setTimeout(
                                                      s,
                                                      this.s.serverWait
                                                  )))
                                                : s(),
                                            this.dom.loader) &&
                                            !this.s.loaderVisible &&
                                            (this.dom.loader.css(
                                                "display",
                                                "block"
                                            ),
                                            (this.s.loaderVisible = !0)))
                                      : (this.s.topRowFloat = this.pixelsToRow(
                                            e,
                                            !1,
                                            !0
                                        )),
                                  (this.s.lastScrollTop = e),
                                  this.s.stateSaveThrottle(),
                                  "jump" === this.s.scrollType &&
                                      this.s.mousedown &&
                                      (this.s.labelVisible = !0),
                                  this.s.labelVisible &&
                                      ((s =
                                          (o.viewport -
                                              o.labelHeight -
                                              o.xbar) /
                                          o.scroll),
                                      this.dom.label
                                          .html(
                                              this.s.dt.fnFormatNumber(
                                                  parseInt(
                                                      this.s.topRowFloat,
                                                      10
                                                  ) + 1
                                              )
                                          )
                                          .css("top", e + e * s)
                                          .css("display", "block")))));
                },
                _scrollForce: function () {
                    var s = this.s.heights;
                    (s.virtual = s.row * this.s.dt.fnRecordsDisplay()),
                        (s.scroll = s.virtual),
                        1e6 < s.scroll && (s.scroll = 1e6),
                        (this.dom.force.style.height =
                            s.scroll > this.s.heights.row
                                ? s.scroll + "px"
                                : this.s.heights.row + "px");
                },
            }),
            (l.oDefaults = l.defaults =
                {
                    boundaryScale: 0.5,
                    displayBuffer: 9,
                    loadingIndicator: !1,
                    rowHeight: "auto",
                    serverWait: 200,
                }),
            (l.version = "2.2.0"),
            f(o).on("preInit.dt.dtscroller", function (s, t) {
                var o, e;
                "dt" === s.namespace &&
                    ((s = t.oInit.scroller),
                    (o = r.defaults.scroller),
                    s || o) &&
                    ((e = f.extend({}, s, o)), !1 !== s) &&
                    new l(t, e);
            }),
            (f.fn.dataTable.Scroller = l),
            (f.fn.DataTable.Scroller = l),
            f.fn.dataTable.Api);
    return (
        s.register("scroller()", function () {
            return this;
        }),
        s.register("scroller().rowToPixels()", function (s, t, o) {
            var e = this.context;
            if (e.length && e[0].oScroller)
                return e[0].oScroller.rowToPixels(s, t, o);
        }),
        s.register("scroller().pixelsToRow()", function (s, t, o) {
            var e = this.context;
            if (e.length && e[0].oScroller)
                return e[0].oScroller.pixelsToRow(s, t, o);
        }),
        s.register(
            ["scroller().scrollToRow()", "scroller.toPosition()"],
            function (t, o) {
                return (
                    this.iterator("table", function (s) {
                        s.oScroller && s.oScroller.scrollToRow(t, o);
                    }),
                    this
                );
            }
        ),
        s.register("row().scrollTo()", function (o) {
            var e = this;
            return (
                this.iterator("row", function (s, t) {
                    s.oScroller &&
                        ((t = e
                            .rows({ order: "applied", search: "applied" })
                            .indexes()
                            .indexOf(t)),
                        s.oScroller.scrollToRow(t, o));
                }),
                this
            );
        }),
        s.register("scroller.measure()", function (t) {
            return (
                this.iterator("table", function (s) {
                    s.oScroller && s.oScroller.measure(t);
                }),
                this
            );
        }),
        s.register("scroller.page()", function () {
            var s = this.context;
            if (s.length && s[0].oScroller) return s[0].oScroller.pageInfo();
        }),
        r
    );
});

/*! Bulma styling wrapper for Scroller
 * © SpryMedia Ltd - datatables.net/license
 */
!(function (t) {
    var o, d;
    "function" == typeof define && define.amd
        ? define(
              ["jquery", "datatables.net-bm", "datatables.net-scroller"],
              function (e) {
                  return t(e, window, document);
              }
          )
        : "object" == typeof exports
        ? ((o = require("jquery")),
          (d = function (e, n) {
              n.fn.dataTable || require("datatables.net-bm")(e, n),
                  n.fn.dataTable.Scroller ||
                      require("datatables.net-scroller")(e, n);
          }),
          "undefined" == typeof window
              ? (module.exports = function (e, n) {
                    return (
                        (e = e || window),
                        (n = n || o(e)),
                        d(e, n),
                        t(n, 0, e.document)
                    );
                })
              : (d(window, o),
                (module.exports = t(o, window, window.document))))
        : t(jQuery, window, document);
})(function (e, n, t, o) {
    "use strict";
    return e.fn.dataTable;
});
