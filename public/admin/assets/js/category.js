!(function (e) {
    var t = {};
    function n(r) {
        if (t[r]) return t[r].exports;
        var a = (t[r] = { i: r, l: !1, exports: {} });
        return e[r].call(a.exports, a, a.exports, n), (a.l = !0), a.exports;
    }
    (n.m = e),
        (n.c = t),
        (n.d = function (e, t, r) {
            n.o(e, t) || Object.defineProperty(e, t, { configurable: !1, enumerable: !0, get: r });
        }),
        (n.n = function (e) {
            var t =
                e && e.__esModule
                    ? function () {
                          return e.default;
                      }
                    : function () {
                          return e;
                      };
            return n.d(t, "a", t), t;
        }),
        (n.o = function (e, t) {
            return Object.prototype.hasOwnProperty.call(e, t);
        }),
        (n.p = "/"),
        n((n.s = 254));
})({
    254: function (e, t, n) {
        e.exports = n(255);
    },
    255: function (e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", { value: !0 });
        var r = (function () {
            function e(e, t) {
                for (var n = 0; n < t.length; n++) {
                    var r = t[n];
                    (r.enumerable = r.enumerable || !1), (r.configurable = !0), "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r);
                }
            }
            return function (t, n, r) {
                return n && e(t.prototype, n), r && e(t, r), t;
            };
        })();
        var a = (function () {
                function e(t, n) {
                    var r = this;
                    !(function (e, t) {
                        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function");
                    })(this, e),
                        (this.selector = n),
                        ($.jstree.defaults.dnd.touch = !0),
                        ($.jstree.defaults.dnd.copy = !1),
                        this.fetchCategoryTree(),
                        n.on("select_node.jstree", function (e, n) {
                            return t.fetchCategory(n.selected[0]);
                        }),
                        n.on("loaded.jstree", function () {
                            return n.jstree("open_all");
                        }),
                        $(document).on("dnd_stop.vakata", function (e, t) {
                            setTimeout(function () {
                                r.updateCategoryTree(t);
                            }, 100);
                        });
                }
                return (
                    r(e, [
                        {
                            key: "fetchCategoryTree",
                            value: function () {
                                this.selector.jstree({ core: { data: { url: route("admin.categories.tree") }, check_callback: !0 }, plugins: ["dnd"] });
                            },
                        },
                        {
                            key: "updateCategoryTree",
                            value: function (e) {
                                var t = this;
                                this.loading(e, !0),
                                    $.ajax({
                                        type: "PUT",
                                        url: route("admin.categories.tree.update"),
                                        data: { category_tree: this.getCategoryTree() },
                                        success: (function (e) {
                                            function t(t) {
                                                return e.apply(this, arguments);
                                            }
                                            return (
                                                (t.toString = function () {
                                                    return e.toString();
                                                }),
                                                t
                                            );
                                        })(function (n) {
                                            success(n), t.loading(e, !1);
                                        }),
                                        error: (function (e) {
                                            function t(t) {
                                                return e.apply(this, arguments);
                                            }
                                            return (
                                                (t.toString = function () {
                                                    return e.toString();
                                                }),
                                                t
                                            );
                                        })(function (n) {
                                            error(n.statusText + ": " + n.responseJSON.message), t.loading(e, !1);
                                        }),
                                    });
                            },
                        },
                        {
                            key: "getCategoryTree",
                            value: function () {
                                return this.selector
                                    .jstree(!0)
                                    .get_json("#", { flat: !0 })
                                    .reduce(function (e, t) {
                                        return e.concat({ id: t.id, parent_id: "#" === t.parent ? null : t.parent, position: t.data.position });
                                    }, []);
                            },
                        },
                        {
                            key: "loading",
                            value: function (e, t) {
                                var n = !0,
                                    r = !1,
                                    a = void 0;
                                try {
                                    for (var o, i = e.data.obj[Symbol.iterator](); !(n = (o = i.next()).done); n = !0) {
                                        var l = o.value;
                                        t ? $(l).addClass("jstree-loading") : $(l).removeClass("jstree-loading");
                                    }
                                } catch (e) {
                                    (r = !0), (a = e);
                                } finally {
                                    try {
                                        !n && i.return && i.return();
                                    } finally {
                                        if (r) throw a;
                                    }
                                }
                            },
                        },
                    ]),
                    e
                );
            })(),
            o = (function () {
                function e(e, t) {
                    for (var n = 0; n < t.length; n++) {
                        var r = t[n];
                        (r.enumerable = r.enumerable || !1), (r.configurable = !0), "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r);
                    }
                }
                return function (t, n, r) {
                    return n && e(t.prototype, n), r && e(t, r), t;
                };
            })();
        new ((function () {
            function e() {
                !(function (e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function");
                })(this, e);
                var t = $(".category-tree");
                new a(this, t), this.collapseAll(t), this.expandAll(t), this.addRootCategory(), this.addSubCategory(), $("#category-form").on("submit", this.submit);
            }
            return (
                o(e, [
                    {
                        key: "collapseAll",
                        value: function (e) {
                            $(".collapse-all").on("click", function (t) {
                                t.preventDefault(), e.jstree("close_all");
                            });
                        },
                    },
                    {
                        key: "expandAll",
                        value: function (e) {
                            $(".expand-all").on("click", function (t) {
                                t.preventDefault(), e.jstree("open_all");
                            });
                        },
                    },
                    {
                        key: "addRootCategory",
                        value: function () {
                            var e = this;
                            $(".add-root-category").on("click", function () {
                                e.loading(!0), $(".add-sub-category").addClass("disabled"), $(".category-tree").jstree("deselect_all"), e.clear(), setTimeout(e.loading, 150, !1);
                            });
                        },
                    },
                    {
                        key: "addSubCategory",
                        value: function () {
                            var e = this;
                            $(".add-sub-category").on("click", function () {
                                var t = $(".category-tree").jstree("get_selected")[0];
                                void 0 !== t && (e.clear(), e.loading(!0), window.form.appendHiddenInput("#category-form", "parent_id", t), setTimeout(e.loading, 150, !1));
                            });
                        },
                    },
                    {
                        key: "fetchCategory",
                        value: function (e) {
                            var t = this;
                            this.loading(!0),
                                $(".add-sub-category").removeClass("disabled"),
                                $.ajax({
                                    type: "GET",
                                    url: route("admin.categories.show", e),
                                    success: function (e) {
                                        t.update(e), t.loading(!1);
                                    },
                                    error: (function (e) {
                                        function t(t) {
                                            return e.apply(this, arguments);
                                        }
                                        return (
                                            (t.toString = function () {
                                                return e.toString();
                                            }),
                                            t
                                        );
                                    })(function (e) {
                                        error(e.statusText + ": " + e.responseJSON.message), t.loading(!1);
                                    }),
                                });
                        },
                    },
                    {
                        key: "update",
                        value: function (e) {
                            window.form.removeErrors(),
                                $(".btn-delete").removeClass("hide"),
                                $(".form-group .help-block").remove(),
                                $("#confirmation-form").attr("action", route("admin.categories.destroy", e.id)),
                                $("#name").val(e.name),
                                null != e.description ? tinyMCE.get("description").setContent(e.description) : tinyMCE.get("description").setContent(""),
                                $("#slug").val(e.slug),
                                $('input[name ="meta[meta_title]"]').val(e.meta.meta_title),
                                $("#meta-description").val(e.meta.meta_description),
                                $("#slug-field").removeClass("hide"),
                                $(".category-details-tab .seo-tab").removeClass("hide"),
                                $("#is_searchable").prop("checked", e.is_searchable),
                                $("#is_active").prop("checked", e.is_active),
                                $('#category-form input[name="parent_id"]').remove();
                        },
                    },
                    {
                        key: "clear",
                        value: function () {
                            $("#name").val(""),
                                tinyMCE.get("description").setContent(""),
                                $("#slug").val(""),
                                $("#slug-field").addClass("hide"),
                                $(".category-details-tab .seo-tab").addClass("hide"),
                                $('input[name ="meta[meta_title]"]').val(""),
                                $("#meta-description").val(""),
                                $("#is_searchable").prop("checked", !1),
                                $("#is_active").prop("checked", !1),
                                $(".btn-delete").addClass("hide"),
                                $(".form-group .help-block").remove(),
                                $('#category-form input[name="parent_id"]').remove(),
                                $(".general-information-tab a").click();
                        },
                    },
                    {
                        key: "loading",
                        value: function (e) {
                            !0 === e ? $(".overlay.loader").removeClass("hide") : $(".overlay.loader").addClass("hide");
                        },
                    },
                    {
                        key: "submit",
                        value: function (e) {
                            var t = $(".category-tree").jstree("get_selected")[0];
                            $("#slug-field").hasClass("hide") || (window.form.appendHiddenInput("#category-form", "_method", "put"), $("#category-form").attr("action", route("admin.categories.update", t))), e.currentTarget.submit();
                        },
                    },
                ]),
                e
            );
        })())();
    },
});
