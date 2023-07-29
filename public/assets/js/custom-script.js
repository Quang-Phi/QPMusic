(function (e, t) {
    "object" == typeof exports && "undefined" != typeof module
        ? (module.exports = t())
        : "function" == typeof define && define.amd
        ? define(t)
        : ((e =
              "undefined" != typeof globalThis
                  ? globalThis
                  : e || self).bootstrap = t());
})(this, function () {
    "use strict";
    const e = "transitionend",
        t = (e) => {
            let t = e.getAttribute("data-bs-target");
            if (!t || "#" === t) {
                let i = e.getAttribute("href");
                if (!i || (!i.includes("#") && !i.startsWith("."))) return null;
                i.includes("#") &&
                    !i.startsWith("#") &&
                    (i = `#${i.split("#")[1]}`),
                    (t = i && "#" !== i ? i.trim() : null);
            }
            return t;
        },
        i = (e) => {
            const i = t(e);
            return i && document.querySelector(i) ? i : null;
        },
        n = (e) => {
            const i = t(e);
            return i ? document.querySelector(i) : null;
        },
        s = (t) => {
            t.dispatchEvent(new Event(e));
        },
        a = (e) =>
            !(!e || "object" != typeof e) &&
            (void 0 !== e.jquery && (e = e[0]), void 0 !== e.nodeType),
        r = (e) =>
            a(e)
                ? e.jquery
                    ? e[0]
                    : e
                : "string" == typeof e && e.length > 0
                ? document.querySelector(e)
                : null,
        o = (e, t, i) => {
            Object.keys(i).forEach((n) => {
                const s = i[n],
                    r = t[n],
                    o =
                        r && a(r)
                            ? "element"
                            : null == (l = r)
                            ? `${l}`
                            : {}.toString
                                  .call(l)
                                  .match(/\s([a-z]+)/i)[1]
                                  .toLowerCase();
                var l;
                if (!new RegExp(s).test(o))
                    throw new TypeError(
                        `${e.toUpperCase()}: Option "${n}" provided type "${o}" but expected type "${s}".`
                    );
            });
        },
        l = (e) =>
            !(!a(e) || 0 === e.getClientRects().length) &&
            "visible" === getComputedStyle(e).getPropertyValue("visibility"),
        u = (e) =>
            !e ||
            e.nodeType !== Node.ELEMENT_NODE ||
            !!e.classList.contains("disabled") ||
            (void 0 !== e.disabled
                ? e.disabled
                : e.hasAttribute("disabled") &&
                  "false" !== e.getAttribute("disabled")),
        d = (e) => {
            if (!document.documentElement.attachShadow) return null;
            if ("function" == typeof e.getRootNode) {
                const t = e.getRootNode();
                return t instanceof ShadowRoot ? t : null;
            }
            return e instanceof ShadowRoot
                ? e
                : e.parentNode
                ? d(e.parentNode)
                : null;
        },
        c = () => {},
        h = (e) => {
            e.offsetHeight;
        },
        f = () => {
            const { jQuery: e } = window;
            return e && !document.body.hasAttribute("data-bs-no-jquery")
                ? e
                : null;
        },
        p = [],
        m = () => "rtl" === document.documentElement.dir,
        g = (e) => {
            var t;
            (t = () => {
                const t = f();
                if (t) {
                    const i = e.NAME,
                        n = t.fn[i];
                    (t.fn[i] = e.jQueryInterface),
                        (t.fn[i].Constructor = e),
                        (t.fn[i].noConflict = () => (
                            (t.fn[i] = n), e.jQueryInterface
                        ));
                }
            }),
                "loading" === document.readyState
                    ? (p.length ||
                          document.addEventListener("DOMContentLoaded", () => {
                              p.forEach((e) => e());
                          }),
                      p.push(t))
                    : t();
        },
        v = (e) => {
            "function" == typeof e && e();
        },
        y = (t, i, n = !0) => {
            if (!n) return void v(t);
            const a =
                ((e) => {
                    if (!e) return 0;
                    let { transitionDuration: t, transitionDelay: i } =
                        window.getComputedStyle(e);
                    const n = Number.parseFloat(t),
                        s = Number.parseFloat(i);
                    return n || s
                        ? ((t = t.split(",")[0]),
                          (i = i.split(",")[0]),
                          1e3 * (Number.parseFloat(t) + Number.parseFloat(i)))
                        : 0;
                })(i) + 5;
            let r = !1;
            const o = ({ target: n }) => {
                n === i && ((r = !0), i.removeEventListener(e, o), v(t));
            };
            i.addEventListener(e, o),
                setTimeout(() => {
                    r || s(i);
                }, a);
        },
        b = (e, t, i, n) => {
            let s = e.indexOf(t);
            if (-1 === s) return e[!i && n ? e.length - 1 : 0];
            const a = e.length;
            return (
                (s += i ? 1 : -1),
                n && (s = (s + a) % a),
                e[Math.max(0, Math.min(s, a - 1))]
            );
        },
        _ = /[^.]*(?=\..*)\.|.*/,
        x = /\..*/,
        w = /::\d+$/,
        S = {};
    let M = 1;
    const E = { mouseenter: "mouseover", mouseleave: "mouseout" },
        k = /^(mouseenter|mouseleave)/i,
        T = new Set([
            "click",
            "dblclick",
            "mouseup",
            "mousedown",
            "contextmenu",
            "mousewheel",
            "DOMMouseScroll",
            "mouseover",
            "mouseout",
            "mousemove",
            "selectstart",
            "selectend",
            "keydown",
            "keypress",
            "keyup",
            "orientationchange",
            "touchstart",
            "touchmove",
            "touchend",
            "touchcancel",
            "pointerdown",
            "pointermove",
            "pointerup",
            "pointerleave",
            "pointercancel",
            "gesturestart",
            "gesturechange",
            "gestureend",
            "focus",
            "blur",
            "change",
            "reset",
            "select",
            "submit",
            "focusin",
            "focusout",
            "load",
            "unload",
            "beforeunload",
            "resize",
            "move",
            "DOMContentLoaded",
            "readystatechange",
            "error",
            "abort",
            "scroll",
        ]);
    function C(e, t) {
        return (t && `${t}::${M++}`) || e.uidEvent || M++;
    }
    function A(e) {
        const t = C(e);
        return (e.uidEvent = t), (S[t] = S[t] || {}), S[t];
    }
    function P(e, t, i = null) {
        const n = Object.keys(e);
        for (let s = 0, a = n.length; s < a; s++) {
            const a = e[n[s]];
            if (a.originalHandler === t && a.delegationSelector === i) return a;
        }
        return null;
    }
    function L(e, t, i) {
        const n = "string" == typeof t,
            s = n ? i : t;
        let a = N(e);
        return T.has(a) || (a = e), [n, s, a];
    }
    function D(e, t, i, n, s) {
        if ("string" != typeof t || !e) return;
        if ((i || ((i = n), (n = null)), k.test(t))) {
            const e = (e) =>
                function (t) {
                    if (
                        !t.relatedTarget ||
                        (t.relatedTarget !== t.delegateTarget &&
                            !t.delegateTarget.contains(t.relatedTarget))
                    )
                        return e.call(this, t);
                };
            n ? (n = e(n)) : (i = e(i));
        }
        const [a, r, o] = L(t, i, n),
            l = A(e),
            u = l[o] || (l[o] = {}),
            d = P(u, r, a ? i : null);
        if (d) return void (d.oneOff = d.oneOff && s);
        const c = C(r, t.replace(_, "")),
            h = a
                ? (function (e, t, i) {
                      return function n(s) {
                          const a = e.querySelectorAll(t);
                          for (
                              let { target: r } = s;
                              r && r !== this;
                              r = r.parentNode
                          )
                              for (let o = a.length; o--; )
                                  if (a[o] === r)
                                      return (
                                          (s.delegateTarget = r),
                                          n.oneOff && I.off(e, s.type, t, i),
                                          i.apply(r, [s])
                                      );
                          return null;
                      };
                  })(e, i, n)
                : (function (e, t) {
                      return function i(n) {
                          return (
                              (n.delegateTarget = e),
                              i.oneOff && I.off(e, n.type, t),
                              t.apply(e, [n])
                          );
                      };
                  })(e, i);
        (h.delegationSelector = a ? i : null),
            (h.originalHandler = r),
            (h.oneOff = s),
            (h.uidEvent = c),
            (u[c] = h),
            e.addEventListener(o, h, a);
    }
    function O(e, t, i, n, s) {
        const a = P(t[i], n, s);
        a && (e.removeEventListener(i, a, Boolean(s)), delete t[i][a.uidEvent]);
    }
    function N(e) {
        return (e = e.replace(x, "")), E[e] || e;
    }
    const I = {
            on(e, t, i, n) {
                D(e, t, i, n, !1);
            },
            one(e, t, i, n) {
                D(e, t, i, n, !0);
            },
            off(e, t, i, n) {
                if ("string" != typeof t || !e) return;
                const [s, a, r] = L(t, i, n),
                    o = r !== t,
                    l = A(e),
                    u = t.startsWith(".");
                if (void 0 !== a) {
                    if (!l || !l[r]) return;
                    return void O(e, l, r, a, s ? i : null);
                }
                u &&
                    Object.keys(l).forEach((i) => {
                        !(function (e, t, i, n) {
                            const s = t[i] || {};
                            Object.keys(s).forEach((a) => {
                                if (a.includes(n)) {
                                    const n = s[a];
                                    O(
                                        e,
                                        t,
                                        i,
                                        n.originalHandler,
                                        n.delegationSelector
                                    );
                                }
                            });
                        })(e, l, i, t.slice(1));
                    });
                const d = l[r] || {};
                Object.keys(d).forEach((i) => {
                    const n = i.replace(w, "");
                    if (!o || t.includes(n)) {
                        const t = d[i];
                        O(e, l, r, t.originalHandler, t.delegationSelector);
                    }
                });
            },
            trigger(e, t, i) {
                if ("string" != typeof t || !e) return null;
                const n = f(),
                    s = N(t),
                    a = t !== s,
                    r = T.has(s);
                let o,
                    l = !0,
                    u = !0,
                    d = !1,
                    c = null;
                return (
                    a &&
                        n &&
                        ((o = n.Event(t, i)),
                        n(e).trigger(o),
                        (l = !o.isPropagationStopped()),
                        (u = !o.isImmediatePropagationStopped()),
                        (d = o.isDefaultPrevented())),
                    r
                        ? ((c = document.createEvent("HTMLEvents")),
                          c.initEvent(s, l, !0))
                        : (c = new CustomEvent(t, {
                              bubbles: l,
                              cancelable: !0,
                          })),
                    void 0 !== i &&
                        Object.keys(i).forEach((e) => {
                            Object.defineProperty(c, e, {
                                get: () => i[e],
                            });
                        }),
                    d && c.preventDefault(),
                    u && e.dispatchEvent(c),
                    c.defaultPrevented && void 0 !== o && o.preventDefault(),
                    c
                );
            },
        },
        R = new Map(),
        z = {
            set(e, t, i) {
                R.has(e) || R.set(e, new Map());
                const n = R.get(e);
                n.has(t) || 0 === n.size
                    ? n.set(t, i)
                    : console.error(
                          `Bootstrap doesn't allow more than one instance per element. Bound instance: ${
                              Array.from(n.keys())[0]
                          }.`
                      );
            },
            get: (e, t) => (R.has(e) && R.get(e).get(t)) || null,
            remove(e, t) {
                if (!R.has(e)) return;
                const i = R.get(e);
                i.delete(t), 0 === i.size && R.delete(e);
            },
        };
    class $ {
        constructor(e) {
            (e = r(e)) &&
                ((this._element = e),
                z.set(this._element, this.constructor.DATA_KEY, this));
        }
        dispose() {
            z.remove(this._element, this.constructor.DATA_KEY),
                I.off(this._element, this.constructor.EVENT_KEY),
                Object.getOwnPropertyNames(this).forEach((e) => {
                    this[e] = null;
                });
        }
        _queueCallback(e, t, i = !0) {
            y(e, t, i);
        }
        static getInstance(e) {
            return z.get(r(e), this.DATA_KEY);
        }
        static getOrCreateInstance(e, t = {}) {
            return (
                this.getInstance(e) ||
                new this(e, "object" == typeof t ? t : null)
            );
        }
        static get VERSION() {
            return "5.1.3";
        }
        static get NAME() {
            throw new Error(
                'You have to implement the static method "NAME", for each component!'
            );
        }
        static get DATA_KEY() {
            return `bs.${this.NAME}`;
        }
        static get EVENT_KEY() {
            return `.${this.DATA_KEY}`;
        }
    }
    const F = (e, t = "hide") => {
        const i = `click.dismiss${e.EVENT_KEY}`,
            s = e.NAME;
        I.on(document, i, `[data-bs-dismiss="${s}"]`, function (i) {
            if (
                (["A", "AREA"].includes(this.tagName) && i.preventDefault(),
                u(this))
            )
                return;
            const a = n(this) || this.closest(`.${s}`);
            e.getOrCreateInstance(a)[t]();
        });
    };
    class H extends $ {
        static get NAME() {
            return "alert";
        }
        close() {
            if (I.trigger(this._element, "close.bs.alert").defaultPrevented)
                return;
            this._element.classList.remove("show");
            const e = this._element.classList.contains("fade");
            this._queueCallback(() => this._destroyElement(), this._element, e);
        }
        _destroyElement() {
            this._element.remove(),
                I.trigger(this._element, "closed.bs.alert"),
                this.dispose();
        }
        static jQueryInterface(e) {
            return this.each(function () {
                const t = H.getOrCreateInstance(this);
                if ("string" == typeof e) {
                    if (
                        void 0 === t[e] ||
                        e.startsWith("_") ||
                        "constructor" === e
                    )
                        throw new TypeError(`No method named "${e}"`);
                    t[e](this);
                }
            });
        }
    }
    F(H, "close"), g(H);
    const j = '[data-bs-toggle="button"]';
    class W extends $ {
        static get NAME() {
            return "button";
        }
        toggle() {
            this._element.setAttribute(
                "aria-pressed",
                this._element.classList.toggle("active")
            );
        }
        static jQueryInterface(e) {
            return this.each(function () {
                const t = W.getOrCreateInstance(this);
                "toggle" === e && t[e]();
            });
        }
    }
    function Y(e) {
        return (
            "true" === e ||
            ("false" !== e &&
                (e === Number(e).toString()
                    ? Number(e)
                    : "" === e || "null" === e
                    ? null
                    : e))
        );
    }
    function B(e) {
        return e.replace(/[A-Z]/g, (e) => `-${e.toLowerCase()}`);
    }
    I.on(document, "click.bs.button.data-api", j, (e) => {
        e.preventDefault();
        const t = e.target.closest(j);
        W.getOrCreateInstance(t).toggle();
    }),
        g(W);
    const V = {
            setDataAttribute(e, t, i) {
                e.setAttribute(`data-bs-${B(t)}`, i);
            },
            removeDataAttribute(e, t) {
                e.removeAttribute(`data-bs-${B(t)}`);
            },
            getDataAttributes(e) {
                if (!e) return {};
                const t = {};
                return (
                    Object.keys(e.dataset)
                        .filter((e) => e.startsWith("bs"))
                        .forEach((i) => {
                            let n = i.replace(/^bs/, "");
                            (n =
                                n.charAt(0).toLowerCase() +
                                n.slice(1, n.length)),
                                (t[n] = Y(e.dataset[i]));
                        }),
                    t
                );
            },
            getDataAttribute: (e, t) => Y(e.getAttribute(`data-bs-${B(t)}`)),
            offset(e) {
                const t = e.getBoundingClientRect();
                return {
                    top: t.top + window.pageYOffset,
                    left: t.left + window.pageXOffset,
                };
            },
            position: (e) => ({ top: e.offsetTop, left: e.offsetLeft }),
        },
        q = {
            find: (e, t = document.documentElement) =>
                [].concat(...Element.prototype.querySelectorAll.call(t, e)),
            findOne: (e, t = document.documentElement) =>
                Element.prototype.querySelector.call(t, e),
            children: (e, t) =>
                [].concat(...e.children).filter((e) => e.matches(t)),
            parents(e, t) {
                const i = [];
                let n = e.parentNode;
                for (
                    ;
                    n && n.nodeType === Node.ELEMENT_NODE && 3 !== n.nodeType;

                )
                    n.matches(t) && i.push(n), (n = n.parentNode);
                return i;
            },
            prev(e, t) {
                let i = e.previousElementSibling;
                for (; i; ) {
                    if (i.matches(t)) return [i];
                    i = i.previousElementSibling;
                }
                return [];
            },
            next(e, t) {
                let i = e.nextElementSibling;
                for (; i; ) {
                    if (i.matches(t)) return [i];
                    i = i.nextElementSibling;
                }
                return [];
            },
            focusableChildren(e) {
                const t = [
                    "a",
                    "button",
                    "input",
                    "textarea",
                    "select",
                    "details",
                    "[tabindex]",
                    '[contenteditable="true"]',
                ]
                    .map((e) => `${e}:not([tabindex^="-"])`)
                    .join(", ");
                return this.find(t, e).filter((e) => !u(e) && l(e));
            },
        },
        U = "carousel",
        X = {
            interval: 5e3,
            keyboard: !0,
            slide: !1,
            pause: "hover",
            wrap: !0,
            touch: !0,
        },
        G = {
            interval: "(number|boolean)",
            keyboard: "boolean",
            slide: "(boolean|string)",
            pause: "(string|boolean)",
            wrap: "boolean",
            touch: "boolean",
        },
        K = "next",
        Q = "prev",
        Z = "left",
        J = "right",
        ee = { ArrowLeft: J, ArrowRight: Z },
        te = "slid.bs.carousel",
        ie = "active",
        ne = ".active.carousel-item";
    class se extends $ {
        constructor(e, t) {
            super(e),
                (this._items = null),
                (this._interval = null),
                (this._activeElement = null),
                (this._isPaused = !1),
                (this._isSliding = !1),
                (this.touchTimeout = null),
                (this.touchStartX = 0),
                (this.touchDeltaX = 0),
                (this._config = this._getConfig(t)),
                (this._indicatorsElement = q.findOne(
                    ".carousel-indicators",
                    this._element
                )),
                (this._touchSupported =
                    "ontouchstart" in document.documentElement ||
                    navigator.maxTouchPoints > 0),
                (this._pointerEvent = Boolean(window.PointerEvent)),
                this._addEventListeners();
        }
        static get Default() {
            return X;
        }
        static get NAME() {
            return U;
        }
        next() {
            this._slide(K);
        }
        nextWhenVisible() {
            !document.hidden && l(this._element) && this.next();
        }
        prev() {
            this._slide(Q);
        }
        pause(e) {
            e || (this._isPaused = !0),
                q.findOne(
                    ".carousel-item-next, .carousel-item-prev",
                    this._element
                ) && (s(this._element), this.cycle(!0)),
                clearInterval(this._interval),
                (this._interval = null);
        }
        cycle(e) {
            e || (this._isPaused = !1),
                this._interval &&
                    (clearInterval(this._interval), (this._interval = null)),
                this._config &&
                    this._config.interval &&
                    !this._isPaused &&
                    (this._updateInterval(),
                    (this._interval = setInterval(
                        (document.visibilityState
                            ? this.nextWhenVisible
                            : this.next
                        ).bind(this),
                        this._config.interval
                    )));
        }
        to(e) {
            this._activeElement = q.findOne(ne, this._element);
            const t = this._getItemIndex(this._activeElement);
            if (e > this._items.length - 1 || e < 0) return;
            if (this._isSliding)
                return void I.one(this._element, te, () => this.to(e));
            if (t === e) return this.pause(), void this.cycle();
            const i = e > t ? K : Q;
            this._slide(i, this._items[e]);
        }
        _getConfig(e) {
            return (
                (e = {
                    ...X,
                    ...V.getDataAttributes(this._element),
                    ...("object" == typeof e ? e : {}),
                }),
                o(U, e, G),
                e
            );
        }
        _handleSwipe() {
            const e = Math.abs(this.touchDeltaX);
            if (e <= 40) return;
            const t = e / this.touchDeltaX;
            (this.touchDeltaX = 0), t && this._slide(t > 0 ? J : Z);
        }
        _addEventListeners() {
            this._config.keyboard &&
                I.on(this._element, "keydown.bs.carousel", (e) =>
                    this._keydown(e)
                ),
                "hover" === this._config.pause &&
                    (I.on(this._element, "mouseenter.bs.carousel", (e) =>
                        this.pause(e)
                    ),
                    I.on(this._element, "mouseleave.bs.carousel", (e) =>
                        this.cycle(e)
                    )),
                this._config.touch &&
                    this._touchSupported &&
                    this._addTouchEventListeners();
        }
        _addTouchEventListeners() {
            const e = (e) =>
                    this._pointerEvent &&
                    ("pen" === e.pointerType || "touch" === e.pointerType),
                t = (t) => {
                    e(t)
                        ? (this.touchStartX = t.clientX)
                        : this._pointerEvent ||
                          (this.touchStartX = t.touches[0].clientX);
                },
                i = (e) => {
                    this.touchDeltaX =
                        e.touches && e.touches.length > 1
                            ? 0
                            : e.touches[0].clientX - this.touchStartX;
                },
                n = (t) => {
                    e(t) && (this.touchDeltaX = t.clientX - this.touchStartX),
                        this._handleSwipe(),
                        "hover" === this._config.pause &&
                            (this.pause(),
                            this.touchTimeout &&
                                clearTimeout(this.touchTimeout),
                            (this.touchTimeout = setTimeout(
                                (e) => this.cycle(e),
                                500 + this._config.interval
                            )));
                };
            q.find(".carousel-item img", this._element).forEach((e) => {
                I.on(e, "dragstart.bs.carousel", (e) => e.preventDefault());
            }),
                this._pointerEvent
                    ? (I.on(this._element, "pointerdown.bs.carousel", (e) =>
                          t(e)
                      ),
                      I.on(this._element, "pointerup.bs.carousel", (e) => n(e)),
                      this._element.classList.add("pointer-event"))
                    : (I.on(this._element, "touchstart.bs.carousel", (e) =>
                          t(e)
                      ),
                      I.on(this._element, "touchmove.bs.carousel", (e) => i(e)),
                      I.on(this._element, "touchend.bs.carousel", (e) => n(e)));
        }
        _keydown(e) {
            if (/input|textarea/i.test(e.target.tagName)) return;
            const t = ee[e.key];
            t && (e.preventDefault(), this._slide(t));
        }
        _getItemIndex(e) {
            return (
                (this._items =
                    e && e.parentNode
                        ? q.find(".carousel-item", e.parentNode)
                        : []),
                this._items.indexOf(e)
            );
        }
        _getItemByOrder(e, t) {
            const i = e === K;
            return b(this._items, t, i, this._config.wrap);
        }
        _triggerSlideEvent(e, t) {
            const i = this._getItemIndex(e),
                n = this._getItemIndex(q.findOne(ne, this._element));
            return I.trigger(this._element, "slide.bs.carousel", {
                relatedTarget: e,
                direction: t,
                from: n,
                to: i,
            });
        }
        _setActiveIndicatorElement(e) {
            if (this._indicatorsElement) {
                const t = q.findOne(".active", this._indicatorsElement);
                t.classList.remove(ie), t.removeAttribute("aria-current");
                const i = q.find("[data-bs-target]", this._indicatorsElement);
                for (let t = 0; t < i.length; t++)
                    if (
                        Number.parseInt(
                            i[t].getAttribute("data-bs-slide-to"),
                            10
                        ) === this._getItemIndex(e)
                    ) {
                        i[t].classList.add(ie),
                            i[t].setAttribute("aria-current", "true");
                        break;
                    }
            }
        }
        _updateInterval() {
            const e = this._activeElement || q.findOne(ne, this._element);
            if (!e) return;
            const t = Number.parseInt(e.getAttribute("data-bs-interval"), 10);
            t
                ? ((this._config.defaultInterval =
                      this._config.defaultInterval || this._config.interval),
                  (this._config.interval = t))
                : (this._config.interval =
                      this._config.defaultInterval || this._config.interval);
        }
        _slide(e, t) {
            const i = this._directionToOrder(e),
                n = q.findOne(ne, this._element),
                s = this._getItemIndex(n),
                a = t || this._getItemByOrder(i, n),
                r = this._getItemIndex(a),
                o = Boolean(this._interval),
                l = i === K,
                u = l ? "carousel-item-start" : "carousel-item-end",
                d = l ? "carousel-item-next" : "carousel-item-prev",
                c = this._orderToDirection(i);
            if (a && a.classList.contains(ie))
                return void (this._isSliding = !1);
            if (this._isSliding) return;
            if (this._triggerSlideEvent(a, c).defaultPrevented) return;
            if (!n || !a) return;
            (this._isSliding = !0),
                o && this.pause(),
                this._setActiveIndicatorElement(a),
                (this._activeElement = a);
            const f = () => {
                I.trigger(this._element, te, {
                    relatedTarget: a,
                    direction: c,
                    from: s,
                    to: r,
                });
            };
            if (this._element.classList.contains("slide")) {
                a.classList.add(d),
                    h(a),
                    n.classList.add(u),
                    a.classList.add(u);
                const e = () => {
                    a.classList.remove(u, d),
                        a.classList.add(ie),
                        n.classList.remove(ie, d, u),
                        (this._isSliding = !1),
                        setTimeout(f, 0);
                };
                this._queueCallback(e, n, !0);
            } else n.classList.remove(ie), a.classList.add(ie), (this._isSliding = !1), f();
            o && this.cycle();
        }
        _directionToOrder(e) {
            return [J, Z].includes(e)
                ? m()
                    ? e === Z
                        ? Q
                        : K
                    : e === Z
                    ? K
                    : Q
                : e;
        }
        _orderToDirection(e) {
            return [K, Q].includes(e)
                ? m()
                    ? e === Q
                        ? Z
                        : J
                    : e === Q
                    ? J
                    : Z
                : e;
        }
        static carouselInterface(e, t) {
            const i = se.getOrCreateInstance(e, t);
            let { _config: n } = i;
            "object" == typeof t && (n = { ...n, ...t });
            const s = "string" == typeof t ? t : n.slide;
            if ("number" == typeof t) i.to(t);
            else if ("string" == typeof s) {
                if (void 0 === i[s])
                    throw new TypeError(`No method named "${s}"`);
                i[s]();
            } else n.interval && n.ride && (i.pause(), i.cycle());
        }
        static jQueryInterface(e) {
            return this.each(function () {
                se.carouselInterface(this, e);
            });
        }
        static dataApiClickHandler(e) {
            const t = n(this);
            if (!t || !t.classList.contains("carousel")) return;
            const i = {
                    ...V.getDataAttributes(t),
                    ...V.getDataAttributes(this),
                },
                s = this.getAttribute("data-bs-slide-to");
            s && (i.interval = !1),
                se.carouselInterface(t, i),
                s && se.getInstance(t).to(s),
                e.preventDefault();
        }
    }
    I.on(
        document,
        "click.bs.carousel.data-api",
        "[data-bs-slide], [data-bs-slide-to]",
        se.dataApiClickHandler
    ),
        I.on(window, "load.bs.carousel.data-api", () => {
            const e = q.find('[data-bs-ride="carousel"]');
            for (let t = 0, i = e.length; t < i; t++)
                se.carouselInterface(e[t], se.getInstance(e[t]));
        }),
        g(se);
    const ae = "collapse",
        re = "bs.collapse",
        oe = { toggle: !0, parent: null },
        le = { toggle: "boolean", parent: "(null|element)" },
        ue = "show",
        de = "collapse",
        ce = "collapsing",
        he = "collapsed",
        fe = ":scope .collapse .collapse",
        pe = '[data-bs-toggle="collapse"]';
    class me extends $ {
        constructor(e, t) {
            super(e),
                (this._isTransitioning = !1),
                (this._config = this._getConfig(t)),
                (this._triggerArray = []);
            const n = q.find(pe);
            for (let e = 0, t = n.length; e < t; e++) {
                const t = n[e],
                    s = i(t),
                    a = q.find(s).filter((e) => e === this._element);
                null !== s &&
                    a.length &&
                    ((this._selector = s), this._triggerArray.push(t));
            }
            this._initializeChildren(),
                this._config.parent ||
                    this._addAriaAndCollapsedClass(
                        this._triggerArray,
                        this._isShown()
                    ),
                this._config.toggle && this.toggle();
        }
        static get Default() {
            return oe;
        }
        static get NAME() {
            return ae;
        }
        toggle() {
            this._isShown() ? this.hide() : this.show();
        }
        show() {
            if (this._isTransitioning || this._isShown()) return;
            let e,
                t = [];
            if (this._config.parent) {
                const e = q.find(fe, this._config.parent);
                t = q
                    .find(
                        ".collapse.show, .collapse.collapsing",
                        this._config.parent
                    )
                    .filter((t) => !e.includes(t));
            }
            const i = q.findOne(this._selector);
            if (t.length) {
                const n = t.find((e) => i !== e);
                if (
                    ((e = n ? me.getInstance(n) : null),
                    e && e._isTransitioning)
                )
                    return;
            }
            if (I.trigger(this._element, "show.bs.collapse").defaultPrevented)
                return;
            t.forEach((t) => {
                i !== t && me.getOrCreateInstance(t, { toggle: !1 }).hide(),
                    e || z.set(t, re, null);
            });
            const n = this._getDimension();
            this._element.classList.remove(de),
                this._element.classList.add(ce),
                (this._element.style[n] = 0),
                this._addAriaAndCollapsedClass(this._triggerArray, !0),
                (this._isTransitioning = !0);
            const s = `scroll${n[0].toUpperCase() + n.slice(1)}`;
            this._queueCallback(
                () => {
                    (this._isTransitioning = !1),
                        this._element.classList.remove(ce),
                        this._element.classList.add(de, ue),
                        (this._element.style[n] = ""),
                        I.trigger(this._element, "shown.bs.collapse");
                },
                this._element,
                !0
            ),
                (this._element.style[n] = `${this._element[s]}px`);
        }
        hide() {
            if (this._isTransitioning || !this._isShown()) return;
            if (I.trigger(this._element, "hide.bs.collapse").defaultPrevented)
                return;
            const e = this._getDimension();
            (this._element.style[e] = `${
                this._element.getBoundingClientRect()[e]
            }px`),
                h(this._element),
                this._element.classList.add(ce),
                this._element.classList.remove(de, ue);
            const t = this._triggerArray.length;
            for (let e = 0; e < t; e++) {
                const t = this._triggerArray[e],
                    i = n(t);
                i &&
                    !this._isShown(i) &&
                    this._addAriaAndCollapsedClass([t], !1);
            }
            this._isTransitioning = !0;
            (this._element.style[e] = ""),
                this._queueCallback(
                    () => {
                        (this._isTransitioning = !1),
                            this._element.classList.remove(ce),
                            this._element.classList.add(de),
                            I.trigger(this._element, "hidden.bs.collapse");
                    },
                    this._element,
                    !0
                );
        }
        _isShown(e = this._element) {
            return e.classList.contains(ue);
        }
        _getConfig(e) {
            return (
                ((e = {
                    ...oe,
                    ...V.getDataAttributes(this._element),
                    ...e,
                }).toggle = Boolean(e.toggle)),
                (e.parent = r(e.parent)),
                o(ae, e, le),
                e
            );
        }
        _getDimension() {
            return this._element.classList.contains("collapse-horizontal")
                ? "width"
                : "height";
        }
        _initializeChildren() {
            if (!this._config.parent) return;
            const e = q.find(fe, this._config.parent);
            q.find(pe, this._config.parent)
                .filter((t) => !e.includes(t))
                .forEach((e) => {
                    const t = n(e);
                    t && this._addAriaAndCollapsedClass([e], this._isShown(t));
                });
        }
        _addAriaAndCollapsedClass(e, t) {
            e.length &&
                e.forEach((e) => {
                    t ? e.classList.remove(he) : e.classList.add(he),
                        e.setAttribute("aria-expanded", t);
                });
        }
        static jQueryInterface(e) {
            return this.each(function () {
                const t = {};
                "string" == typeof e && /show|hide/.test(e) && (t.toggle = !1);
                const i = me.getOrCreateInstance(this, t);
                if ("string" == typeof e) {
                    if (void 0 === i[e])
                        throw new TypeError(`No method named "${e}"`);
                    i[e]();
                }
            });
        }
    }
    I.on(document, "click.bs.collapse.data-api", pe, function (e) {
        ("A" === e.target.tagName ||
            (e.delegateTarget && "A" === e.delegateTarget.tagName)) &&
            e.preventDefault();
        const t = i(this);
        q.find(t).forEach((e) => {
            me.getOrCreateInstance(e, { toggle: !1 }).toggle();
        });
    }),
        g(me);
    var ge = "top",
        ve = "bottom",
        ye = "right",
        be = "left",
        _e = "auto",
        xe = [ge, ve, ye, be],
        we = "start",
        Se = "end",
        Me = "clippingParents",
        Ee = "viewport",
        ke = "popper",
        Te = "reference",
        Ce = xe.reduce(function (e, t) {
            return e.concat([t + "-" + we, t + "-" + Se]);
        }, []),
        Ae = [].concat(xe, [_e]).reduce(function (e, t) {
            return e.concat([t, t + "-" + we, t + "-" + Se]);
        }, []),
        Pe = "beforeRead",
        Le = "read",
        De = "afterRead",
        Oe = "beforeMain",
        Ne = "main",
        Ie = "afterMain",
        Re = "beforeWrite",
        ze = "write",
        $e = "afterWrite",
        Fe = [Pe, Le, De, Oe, Ne, Ie, Re, ze, $e];
    function He(e) {
        return e ? (e.nodeName || "").toLowerCase() : null;
    }
    function je(e) {
        if (null == e) return window;
        if ("[object Window]" !== e.toString()) {
            var t = e.ownerDocument;
            return (t && t.defaultView) || window;
        }
        return e;
    }
    function We(e) {
        return e instanceof je(e).Element || e instanceof Element;
    }
    function Ye(e) {
        return e instanceof je(e).HTMLElement || e instanceof HTMLElement;
    }
    function Be(e) {
        return (
            "undefined" != typeof ShadowRoot &&
            (e instanceof je(e).ShadowRoot || e instanceof ShadowRoot)
        );
    }
    const Ve = {
        name: "applyStyles",
        enabled: !0,
        phase: "write",
        fn: function (e) {
            var t = e.state;
            Object.keys(t.elements).forEach(function (e) {
                var i = t.styles[e] || {},
                    n = t.attributes[e] || {},
                    s = t.elements[e];
                Ye(s) &&
                    He(s) &&
                    (Object.assign(s.style, i),
                    Object.keys(n).forEach(function (e) {
                        var t = n[e];
                        !1 === t
                            ? s.removeAttribute(e)
                            : s.setAttribute(e, !0 === t ? "" : t);
                    }));
            });
        },
        effect: function (e) {
            var t = e.state,
                i = {
                    popper: {
                        position: t.options.strategy,
                        left: "0",
                        top: "0",
                        margin: "0",
                    },
                    arrow: { position: "absolute" },
                    reference: {},
                };
            return (
                Object.assign(t.elements.popper.style, i.popper),
                (t.styles = i),
                t.elements.arrow &&
                    Object.assign(t.elements.arrow.style, i.arrow),
                function () {
                    Object.keys(t.elements).forEach(function (e) {
                        var n = t.elements[e],
                            s = t.attributes[e] || {},
                            a = Object.keys(
                                t.styles.hasOwnProperty(e) ? t.styles[e] : i[e]
                            ).reduce(function (e, t) {
                                return (e[t] = ""), e;
                            }, {});
                        Ye(n) &&
                            He(n) &&
                            (Object.assign(n.style, a),
                            Object.keys(s).forEach(function (e) {
                                n.removeAttribute(e);
                            }));
                    });
                }
            );
        },
        requires: ["computeStyles"],
    };
    function qe(e) {
        return e.split("-")[0];
    }
    function Ue(e, t) {
        var i = e.getBoundingClientRect();
        return {
            width: i.width / 1,
            height: i.height / 1,
            top: i.top / 1,
            right: i.right / 1,
            bottom: i.bottom / 1,
            left: i.left / 1,
            x: i.left / 1,
            y: i.top / 1,
        };
    }
    function Xe(e) {
        var t = Ue(e),
            i = e.offsetWidth,
            n = e.offsetHeight;
        return (
            Math.abs(t.width - i) <= 1 && (i = t.width),
            Math.abs(t.height - n) <= 1 && (n = t.height),
            { x: e.offsetLeft, y: e.offsetTop, width: i, height: n }
        );
    }
    function Ge(e, t) {
        var i = t.getRootNode && t.getRootNode();
        if (e.contains(t)) return !0;
        if (i && Be(i)) {
            var n = t;
            do {
                if (n && e.isSameNode(n)) return !0;
                n = n.parentNode || n.host;
            } while (n);
        }
        return !1;
    }
    function Ke(e) {
        return je(e).getComputedStyle(e);
    }
    function Qe(e) {
        return ["table", "td", "th"].indexOf(He(e)) >= 0;
    }
    function Ze(e) {
        return (
            (We(e) ? e.ownerDocument : e.document) || window.document
        ).documentElement;
    }
    function Je(e) {
        return "html" === He(e)
            ? e
            : e.assignedSlot ||
                  e.parentNode ||
                  (Be(e) ? e.host : null) ||
                  Ze(e);
    }
    function et(e) {
        return Ye(e) && "fixed" !== Ke(e).position ? e.offsetParent : null;
    }
    function tt(e) {
        for (
            var t = je(e), i = et(e);
            i && Qe(i) && "static" === Ke(i).position;

        )
            i = et(i);
        return i &&
            ("html" === He(i) ||
                ("body" === He(i) && "static" === Ke(i).position))
            ? t
            : i ||
                  (function (e) {
                      var t =
                          -1 !==
                          navigator.userAgent.toLowerCase().indexOf("firefox");
                      if (
                          -1 !== navigator.userAgent.indexOf("Trident") &&
                          Ye(e) &&
                          "fixed" === Ke(e).position
                      )
                          return null;
                      for (
                          var i = Je(e);
                          Ye(i) && ["html", "body"].indexOf(He(i)) < 0;

                      ) {
                          var n = Ke(i);
                          if (
                              "none" !== n.transform ||
                              "none" !== n.perspective ||
                              "paint" === n.contain ||
                              -1 !==
                                  ["transform", "perspective"].indexOf(
                                      n.willChange
                                  ) ||
                              (t && "filter" === n.willChange) ||
                              (t && n.filter && "none" !== n.filter)
                          )
                              return i;
                          i = i.parentNode;
                      }
                      return null;
                  })(e) ||
                  t;
    }
    function it(e) {
        return ["top", "bottom"].indexOf(e) >= 0 ? "x" : "y";
    }
    var nt = Math.max,
        st = Math.min,
        at = Math.round;
    function rt(e, t, i) {
        return nt(e, st(t, i));
    }
    function ot(e) {
        return Object.assign({}, { top: 0, right: 0, bottom: 0, left: 0 }, e);
    }
    function lt(e, t) {
        return t.reduce(function (t, i) {
            return (t[i] = e), t;
        }, {});
    }
    const ut = {
        name: "arrow",
        enabled: !0,
        phase: "main",
        fn: function (e) {
            var t,
                i = e.state,
                n = e.name,
                s = e.options,
                a = i.elements.arrow,
                r = i.modifiersData.popperOffsets,
                o = qe(i.placement),
                l = it(o),
                u = [be, ye].indexOf(o) >= 0 ? "height" : "width";
            if (a && r) {
                var d = (function (e, t) {
                        return ot(
                            "number" !=
                                typeof (e =
                                    "function" == typeof e
                                        ? e(
                                              Object.assign({}, t.rects, {
                                                  placement: t.placement,
                                              })
                                          )
                                        : e)
                                ? e
                                : lt(e, xe)
                        );
                    })(s.padding, i),
                    c = Xe(a),
                    h = "y" === l ? ge : be,
                    f = "y" === l ? ve : ye,
                    p =
                        i.rects.reference[u] +
                        i.rects.reference[l] -
                        r[l] -
                        i.rects.popper[u],
                    m = r[l] - i.rects.reference[l],
                    g = tt(a),
                    v = g
                        ? "y" === l
                            ? g.clientHeight || 0
                            : g.clientWidth || 0
                        : 0,
                    y = p / 2 - m / 2,
                    b = d[h],
                    _ = v - c[u] - d[f],
                    x = v / 2 - c[u] / 2 + y,
                    w = rt(b, x, _),
                    S = l;
                i.modifiersData[n] =
                    (((t = {})[S] = w), (t.centerOffset = w - x), t);
            }
        },
        effect: function (e) {
            var t = e.state,
                i = e.options.element,
                n = void 0 === i ? "[data-popper-arrow]" : i;
            null != n &&
                ("string" != typeof n ||
                    (n = t.elements.popper.querySelector(n))) &&
                Ge(t.elements.popper, n) &&
                (t.elements.arrow = n);
        },
        requires: ["popperOffsets"],
        requiresIfExists: ["preventOverflow"],
    };
    function dt(e) {
        return e.split("-")[1];
    }
    var ct = { top: "auto", right: "auto", bottom: "auto", left: "auto" };
    function ht(e) {
        var t,
            i = e.popper,
            n = e.popperRect,
            s = e.placement,
            a = e.variation,
            r = e.offsets,
            o = e.position,
            l = e.gpuAcceleration,
            u = e.adaptive,
            d = e.roundOffsets,
            c =
                !0 === d
                    ? (function (e) {
                          var t = e.x,
                              i = e.y,
                              n = window.devicePixelRatio || 1;
                          return {
                              x: at(at(t * n) / n) || 0,
                              y: at(at(i * n) / n) || 0,
                          };
                      })(r)
                    : "function" == typeof d
                    ? d(r)
                    : r,
            h = c.x,
            f = void 0 === h ? 0 : h,
            p = c.y,
            m = void 0 === p ? 0 : p,
            g = r.hasOwnProperty("x"),
            v = r.hasOwnProperty("y"),
            y = be,
            b = ge,
            _ = window;
        if (u) {
            var x = tt(i),
                w = "clientHeight",
                S = "clientWidth";
            x === je(i) &&
                "static" !== Ke((x = Ze(i))).position &&
                "absolute" === o &&
                ((w = "scrollHeight"), (S = "scrollWidth")),
                (s !== ge && ((s !== be && s !== ye) || a !== Se)) ||
                    ((b = ve), (m -= x[w] - n.height), (m *= l ? 1 : -1)),
                (s !== be && ((s !== ge && s !== ve) || a !== Se)) ||
                    ((y = ye), (f -= x[S] - n.width), (f *= l ? 1 : -1));
        }
        var M,
            E = Object.assign({ position: o }, u && ct);
        return l
            ? Object.assign(
                  {},
                  E,
                  (((M = {})[b] = v ? "0" : ""),
                  (M[y] = g ? "0" : ""),
                  (M.transform =
                      (_.devicePixelRatio || 1) <= 1
                          ? "translate(" + f + "px, " + m + "px)"
                          : "translate3d(" + f + "px, " + m + "px, 0)"),
                  M)
              )
            : Object.assign(
                  {},
                  E,
                  (((t = {})[b] = v ? m + "px" : ""),
                  (t[y] = g ? f + "px" : ""),
                  (t.transform = ""),
                  t)
              );
    }
    const ft = {
        name: "computeStyles",
        enabled: !0,
        phase: "beforeWrite",
        fn: function (e) {
            var t = e.state,
                i = e.options,
                n = i.gpuAcceleration,
                s = void 0 === n || n,
                a = i.adaptive,
                r = void 0 === a || a,
                o = i.roundOffsets,
                l = void 0 === o || o,
                u = {
                    placement: qe(t.placement),
                    variation: dt(t.placement),
                    popper: t.elements.popper,
                    popperRect: t.rects.popper,
                    gpuAcceleration: s,
                };
            null != t.modifiersData.popperOffsets &&
                (t.styles.popper = Object.assign(
                    {},
                    t.styles.popper,
                    ht(
                        Object.assign({}, u, {
                            offsets: t.modifiersData.popperOffsets,
                            position: t.options.strategy,
                            adaptive: r,
                            roundOffsets: l,
                        })
                    )
                )),
                null != t.modifiersData.arrow &&
                    (t.styles.arrow = Object.assign(
                        {},
                        t.styles.arrow,
                        ht(
                            Object.assign({}, u, {
                                offsets: t.modifiersData.arrow,
                                position: "absolute",
                                adaptive: !1,
                                roundOffsets: l,
                            })
                        )
                    )),
                (t.attributes.popper = Object.assign({}, t.attributes.popper, {
                    "data-popper-placement": t.placement,
                }));
        },
        data: {},
    };
    var pt = { passive: !0 };
    const mt = {
        name: "eventListeners",
        enabled: !0,
        phase: "write",
        fn: function () {},
        effect: function (e) {
            var t = e.state,
                i = e.instance,
                n = e.options,
                s = n.scroll,
                a = void 0 === s || s,
                r = n.resize,
                o = void 0 === r || r,
                l = je(t.elements.popper),
                u = [].concat(
                    t.scrollParents.reference,
                    t.scrollParents.popper
                );
            return (
                a &&
                    u.forEach(function (e) {
                        e.addEventListener("scroll", i.update, pt);
                    }),
                o && l.addEventListener("resize", i.update, pt),
                function () {
                    a &&
                        u.forEach(function (e) {
                            e.removeEventListener("scroll", i.update, pt);
                        }),
                        o && l.removeEventListener("resize", i.update, pt);
                }
            );
        },
        data: {},
    };
    var gt = { left: "right", right: "left", bottom: "top", top: "bottom" };
    function vt(e) {
        return e.replace(/left|right|bottom|top/g, function (e) {
            return gt[e];
        });
    }
    var yt = { start: "end", end: "start" };
    function bt(e) {
        return e.replace(/start|end/g, function (e) {
            return yt[e];
        });
    }
    function _t(e) {
        var t = je(e);
        return { scrollLeft: t.pageXOffset, scrollTop: t.pageYOffset };
    }
    function xt(e) {
        return Ue(Ze(e)).left + _t(e).scrollLeft;
    }
    function wt(e) {
        var t = Ke(e),
            i = t.overflow,
            n = t.overflowX,
            s = t.overflowY;
        return /auto|scroll|overlay|hidden/.test(i + s + n);
    }
    function St(e) {
        return ["html", "body", "#document"].indexOf(He(e)) >= 0
            ? e.ownerDocument.body
            : Ye(e) && wt(e)
            ? e
            : St(Je(e));
    }
    function Mt(e, t) {
        var i;
        void 0 === t && (t = []);
        var n = St(e),
            s = n === (null == (i = e.ownerDocument) ? void 0 : i.body),
            a = je(n),
            r = s ? [a].concat(a.visualViewport || [], wt(n) ? n : []) : n,
            o = t.concat(r);
        return s ? o : o.concat(Mt(Je(r)));
    }
    function Et(e) {
        return Object.assign({}, e, {
            left: e.x,
            top: e.y,
            right: e.x + e.width,
            bottom: e.y + e.height,
        });
    }
    function kt(e, t) {
        return t === Ee
            ? Et(
                  (function (e) {
                      var t = je(e),
                          i = Ze(e),
                          n = t.visualViewport,
                          s = i.clientWidth,
                          a = i.clientHeight,
                          r = 0,
                          o = 0;
                      return (
                          n &&
                              ((s = n.width),
                              (a = n.height),
                              /^((?!chrome|android).)*safari/i.test(
                                  navigator.userAgent
                              ) || ((r = n.offsetLeft), (o = n.offsetTop))),
                          { width: s, height: a, x: r + xt(e), y: o }
                      );
                  })(e)
              )
            : Ye(t)
            ? (function (e) {
                  var t = Ue(e);
                  return (
                      (t.top = t.top + e.clientTop),
                      (t.left = t.left + e.clientLeft),
                      (t.bottom = t.top + e.clientHeight),
                      (t.right = t.left + e.clientWidth),
                      (t.width = e.clientWidth),
                      (t.height = e.clientHeight),
                      (t.x = t.left),
                      (t.y = t.top),
                      t
                  );
              })(t)
            : Et(
                  (function (e) {
                      var t,
                          i = Ze(e),
                          n = _t(e),
                          s = null == (t = e.ownerDocument) ? void 0 : t.body,
                          a = nt(
                              i.scrollWidth,
                              i.clientWidth,
                              s ? s.scrollWidth : 0,
                              s ? s.clientWidth : 0
                          ),
                          r = nt(
                              i.scrollHeight,
                              i.clientHeight,
                              s ? s.scrollHeight : 0,
                              s ? s.clientHeight : 0
                          ),
                          o = -n.scrollLeft + xt(e),
                          l = -n.scrollTop;
                      return (
                          "rtl" === Ke(s || i).direction &&
                              (o +=
                                  nt(i.clientWidth, s ? s.clientWidth : 0) - a),
                          { width: a, height: r, x: o, y: l }
                      );
                  })(Ze(e))
              );
    }
    function Tt(e, t, i) {
        var n =
                "clippingParents" === t
                    ? (function (e) {
                          var t = Mt(Je(e)),
                              i =
                                  ["absolute", "fixed"].indexOf(
                                      Ke(e).position
                                  ) >= 0 && Ye(e)
                                      ? tt(e)
                                      : e;
                          return We(i)
                              ? t.filter(function (e) {
                                    return (
                                        We(e) && Ge(e, i) && "body" !== He(e)
                                    );
                                })
                              : [];
                      })(e)
                    : [].concat(t),
            s = [].concat(n, [i]),
            a = s[0],
            r = s.reduce(function (t, i) {
                var n = kt(e, i);
                return (
                    (t.top = nt(n.top, t.top)),
                    (t.right = st(n.right, t.right)),
                    (t.bottom = st(n.bottom, t.bottom)),
                    (t.left = nt(n.left, t.left)),
                    t
                );
            }, kt(e, a));
        return (
            (r.width = r.right - r.left),
            (r.height = r.bottom - r.top),
            (r.x = r.left),
            (r.y = r.top),
            r
        );
    }
    function Ct(e) {
        var t,
            i = e.reference,
            n = e.element,
            s = e.placement,
            a = s ? qe(s) : null,
            r = s ? dt(s) : null,
            o = i.x + i.width / 2 - n.width / 2,
            l = i.y + i.height / 2 - n.height / 2;
        switch (a) {
            case ge:
                t = { x: o, y: i.y - n.height };
                break;
            case ve:
                t = { x: o, y: i.y + i.height };
                break;
            case ye:
                t = { x: i.x + i.width, y: l };
                break;
            case be:
                t = { x: i.x - n.width, y: l };
                break;
            default:
                t = { x: i.x, y: i.y };
        }
        var u = a ? it(a) : null;
        if (null != u) {
            var d = "y" === u ? "height" : "width";
            switch (r) {
                case we:
                    t[u] = t[u] - (i[d] / 2 - n[d] / 2);
                    break;
                case Se:
                    t[u] = t[u] + (i[d] / 2 - n[d] / 2);
            }
        }
        return t;
    }
    function At(e, t) {
        void 0 === t && (t = {});
        var i = t,
            n = i.placement,
            s = void 0 === n ? e.placement : n,
            a = i.boundary,
            r = void 0 === a ? Me : a,
            o = i.rootBoundary,
            l = void 0 === o ? Ee : o,
            u = i.elementContext,
            d = void 0 === u ? ke : u,
            c = i.altBoundary,
            h = void 0 !== c && c,
            f = i.padding,
            p = void 0 === f ? 0 : f,
            m = ot("number" != typeof p ? p : lt(p, xe)),
            g = d === ke ? Te : ke,
            v = e.rects.popper,
            y = e.elements[h ? g : d],
            b = Tt(We(y) ? y : y.contextElement || Ze(e.elements.popper), r, l),
            _ = Ue(e.elements.reference),
            x = Ct({
                reference: _,
                element: v,
                strategy: "absolute",
                placement: s,
            }),
            w = Et(Object.assign({}, v, x)),
            S = d === ke ? w : _,
            M = {
                top: b.top - S.top + m.top,
                bottom: S.bottom - b.bottom + m.bottom,
                left: b.left - S.left + m.left,
                right: S.right - b.right + m.right,
            },
            E = e.modifiersData.offset;
        if (d === ke && E) {
            var k = E[s];
            Object.keys(M).forEach(function (e) {
                var t = [ye, ve].indexOf(e) >= 0 ? 1 : -1,
                    i = [ge, ve].indexOf(e) >= 0 ? "y" : "x";
                M[e] += k[i] * t;
            });
        }
        return M;
    }
    function Pt(e, t) {
        void 0 === t && (t = {});
        var i = t,
            n = i.placement,
            s = i.boundary,
            a = i.rootBoundary,
            r = i.padding,
            o = i.flipVariations,
            l = i.allowedAutoPlacements,
            u = void 0 === l ? Ae : l,
            d = dt(n),
            c = d
                ? o
                    ? Ce
                    : Ce.filter(function (e) {
                          return dt(e) === d;
                      })
                : xe,
            h = c.filter(function (e) {
                return u.indexOf(e) >= 0;
            });
        0 === h.length && (h = c);
        var f = h.reduce(function (t, i) {
            return (
                (t[i] = At(e, {
                    placement: i,
                    boundary: s,
                    rootBoundary: a,
                    padding: r,
                })[qe(i)]),
                t
            );
        }, {});
        return Object.keys(f).sort(function (e, t) {
            return f[e] - f[t];
        });
    }
    const Lt = {
        name: "flip",
        enabled: !0,
        phase: "main",
        fn: function (e) {
            var t = e.state,
                i = e.options,
                n = e.name;
            if (!t.modifiersData[n]._skip) {
                for (
                    var s = i.mainAxis,
                        a = void 0 === s || s,
                        r = i.altAxis,
                        o = void 0 === r || r,
                        l = i.fallbackPlacements,
                        u = i.padding,
                        d = i.boundary,
                        c = i.rootBoundary,
                        h = i.altBoundary,
                        f = i.flipVariations,
                        p = void 0 === f || f,
                        m = i.allowedAutoPlacements,
                        g = t.options.placement,
                        v = qe(g),
                        y =
                            l ||
                            (v === g || !p
                                ? [vt(g)]
                                : (function (e) {
                                      if (qe(e) === _e) return [];
                                      var t = vt(e);
                                      return [bt(e), t, bt(t)];
                                  })(g)),
                        b = [g].concat(y).reduce(function (e, i) {
                            return e.concat(
                                qe(i) === _e
                                    ? Pt(t, {
                                          placement: i,
                                          boundary: d,
                                          rootBoundary: c,
                                          padding: u,
                                          flipVariations: p,
                                          allowedAutoPlacements: m,
                                      })
                                    : i
                            );
                        }, []),
                        _ = t.rects.reference,
                        x = t.rects.popper,
                        w = new Map(),
                        S = !0,
                        M = b[0],
                        E = 0;
                    E < b.length;
                    E++
                ) {
                    var k = b[E],
                        T = qe(k),
                        C = dt(k) === we,
                        A = [ge, ve].indexOf(T) >= 0,
                        P = A ? "width" : "height",
                        L = At(t, {
                            placement: k,
                            boundary: d,
                            rootBoundary: c,
                            altBoundary: h,
                            padding: u,
                        }),
                        D = A ? (C ? ye : be) : C ? ve : ge;
                    _[P] > x[P] && (D = vt(D));
                    var O = vt(D),
                        N = [];
                    if (
                        (a && N.push(L[T] <= 0),
                        o && N.push(L[D] <= 0, L[O] <= 0),
                        N.every(function (e) {
                            return e;
                        }))
                    ) {
                        (M = k), (S = !1);
                        break;
                    }
                    w.set(k, N);
                }
                if (S)
                    for (
                        var I = function (e) {
                                var t = b.find(function (t) {
                                    var i = w.get(t);
                                    if (i)
                                        return i
                                            .slice(0, e)
                                            .every(function (e) {
                                                return e;
                                            });
                                });
                                if (t) return (M = t), "break";
                            },
                            R = p ? 3 : 1;
                        R > 0;
                        R--
                    ) {
                        if ("break" === I(R)) break;
                    }
                t.placement !== M &&
                    ((t.modifiersData[n]._skip = !0),
                    (t.placement = M),
                    (t.reset = !0));
            }
        },
        requiresIfExists: ["offset"],
        data: { _skip: !1 },
    };
    function Dt(e, t, i) {
        return (
            void 0 === i && (i = { x: 0, y: 0 }),
            {
                top: e.top - t.height - i.y,
                right: e.right - t.width + i.x,
                bottom: e.bottom - t.height + i.y,
                left: e.left - t.width - i.x,
            }
        );
    }
    function Ot(e) {
        return [ge, ye, ve, be].some(function (t) {
            return e[t] >= 0;
        });
    }
    const Nt = {
        name: "hide",
        enabled: !0,
        phase: "main",
        requiresIfExists: ["preventOverflow"],
        fn: function (e) {
            var t = e.state,
                i = e.name,
                n = t.rects.reference,
                s = t.rects.popper,
                a = t.modifiersData.preventOverflow,
                r = At(t, { elementContext: "reference" }),
                o = At(t, { altBoundary: !0 }),
                l = Dt(r, n),
                u = Dt(o, s, a),
                d = Ot(l),
                c = Ot(u);
            (t.modifiersData[i] = {
                referenceClippingOffsets: l,
                popperEscapeOffsets: u,
                isReferenceHidden: d,
                hasPopperEscaped: c,
            }),
                (t.attributes.popper = Object.assign({}, t.attributes.popper, {
                    "data-popper-reference-hidden": d,
                    "data-popper-escaped": c,
                }));
        },
    };
    const It = {
        name: "offset",
        enabled: !0,
        phase: "main",
        requires: ["popperOffsets"],
        fn: function (e) {
            var t = e.state,
                i = e.options,
                n = e.name,
                s = i.offset,
                a = void 0 === s ? [0, 0] : s,
                r = Ae.reduce(function (e, i) {
                    return (
                        (e[i] = (function (e, t, i) {
                            var n = qe(e),
                                s = [be, ge].indexOf(n) >= 0 ? -1 : 1,
                                a =
                                    "function" == typeof i
                                        ? i(
                                              Object.assign({}, t, {
                                                  placement: e,
                                              })
                                          )
                                        : i,
                                r = a[0],
                                o = a[1];
                            return (
                                (r = r || 0),
                                (o = (o || 0) * s),
                                [be, ye].indexOf(n) >= 0
                                    ? { x: o, y: r }
                                    : { x: r, y: o }
                            );
                        })(i, t.rects, a)),
                        e
                    );
                }, {}),
                o = r[t.placement],
                l = o.x,
                u = o.y;
            null != t.modifiersData.popperOffsets &&
                ((t.modifiersData.popperOffsets.x += l),
                (t.modifiersData.popperOffsets.y += u)),
                (t.modifiersData[n] = r);
        },
    };
    const Rt = {
        name: "popperOffsets",
        enabled: !0,
        phase: "read",
        fn: function (e) {
            var t = e.state,
                i = e.name;
            t.modifiersData[i] = Ct({
                reference: t.rects.reference,
                element: t.rects.popper,
                strategy: "absolute",
                placement: t.placement,
            });
        },
        data: {},
    };
    const zt = {
        name: "preventOverflow",
        enabled: !0,
        phase: "main",
        fn: function (e) {
            var t = e.state,
                i = e.options,
                n = e.name,
                s = i.mainAxis,
                a = void 0 === s || s,
                r = i.altAxis,
                o = void 0 !== r && r,
                l = i.boundary,
                u = i.rootBoundary,
                d = i.altBoundary,
                c = i.padding,
                h = i.tether,
                f = void 0 === h || h,
                p = i.tetherOffset,
                m = void 0 === p ? 0 : p,
                g = At(t, {
                    boundary: l,
                    rootBoundary: u,
                    padding: c,
                    altBoundary: d,
                }),
                v = qe(t.placement),
                y = dt(t.placement),
                b = !y,
                _ = it(v),
                x = "x" === _ ? "y" : "x",
                w = t.modifiersData.popperOffsets,
                S = t.rects.reference,
                M = t.rects.popper,
                E =
                    "function" == typeof m
                        ? m(
                              Object.assign({}, t.rects, {
                                  placement: t.placement,
                              })
                          )
                        : m,
                k = { x: 0, y: 0 };
            if (w) {
                if (a || o) {
                    var T = "y" === _ ? ge : be,
                        C = "y" === _ ? ve : ye,
                        A = "y" === _ ? "height" : "width",
                        P = w[_],
                        L = w[_] + g[T],
                        D = w[_] - g[C],
                        O = f ? -M[A] / 2 : 0,
                        N = y === we ? S[A] : M[A],
                        I = y === we ? -M[A] : -S[A],
                        R = t.elements.arrow,
                        z = f && R ? Xe(R) : { width: 0, height: 0 },
                        $ = t.modifiersData["arrow#persistent"]
                            ? t.modifiersData["arrow#persistent"].padding
                            : { top: 0, right: 0, bottom: 0, left: 0 },
                        F = $[T],
                        H = $[C],
                        j = rt(0, S[A], z[A]),
                        W = b ? S[A] / 2 - O - j - F - E : N - j - F - E,
                        Y = b ? -S[A] / 2 + O + j + H + E : I + j + H + E,
                        B = t.elements.arrow && tt(t.elements.arrow),
                        V = B
                            ? "y" === _
                                ? B.clientTop || 0
                                : B.clientLeft || 0
                            : 0,
                        q = t.modifiersData.offset
                            ? t.modifiersData.offset[t.placement][_]
                            : 0,
                        U = w[_] + W - q - V,
                        X = w[_] + Y - q;
                    if (a) {
                        var G = rt(f ? st(L, U) : L, P, f ? nt(D, X) : D);
                        (w[_] = G), (k[_] = G - P);
                    }
                    if (o) {
                        var K = "x" === _ ? ge : be,
                            Q = "x" === _ ? ve : ye,
                            Z = w[x],
                            J = Z + g[K],
                            ee = Z - g[Q],
                            te = rt(f ? st(J, U) : J, Z, f ? nt(ee, X) : ee);
                        (w[x] = te), (k[x] = te - Z);
                    }
                }
                t.modifiersData[n] = k;
            }
        },
        requiresIfExists: ["offset"],
    };
    function $t(e, t, i) {
        void 0 === i && (i = !1);
        var n = Ye(t);
        Ye(t) &&
            (function (e) {
                var t = e.getBoundingClientRect(),
                    i = t.width / e.offsetWidth || 1,
                    n = t.height / e.offsetHeight || 1;
            })(t);
        var s,
            a,
            r = Ze(t),
            o = Ue(e),
            l = { scrollLeft: 0, scrollTop: 0 },
            u = { x: 0, y: 0 };
        return (
            (n || (!n && !i)) &&
                (("body" !== He(t) || wt(r)) &&
                    (l =
                        (s = t) !== je(s) && Ye(s)
                            ? {
                                  scrollLeft: (a = s).scrollLeft,
                                  scrollTop: a.scrollTop,
                              }
                            : _t(s)),
                Ye(t)
                    ? (((u = Ue(t)).x += t.clientLeft), (u.y += t.clientTop))
                    : r && (u.x = xt(r))),
            {
                x: o.left + l.scrollLeft - u.x,
                y: o.top + l.scrollTop - u.y,
                width: o.width,
                height: o.height,
            }
        );
    }
    function Ft(e) {
        var t = new Map(),
            i = new Set(),
            n = [];
        function s(e) {
            i.add(e.name),
                []
                    .concat(e.requires || [], e.requiresIfExists || [])
                    .forEach(function (e) {
                        if (!i.has(e)) {
                            var n = t.get(e);
                            n && s(n);
                        }
                    }),
                n.push(e);
        }
        return (
            e.forEach(function (e) {
                t.set(e.name, e);
            }),
            e.forEach(function (e) {
                i.has(e.name) || s(e);
            }),
            n
        );
    }
    var Ht = { placement: "bottom", modifiers: [], strategy: "absolute" };
    function jt() {
        for (var e = arguments.length, t = new Array(e), i = 0; i < e; i++)
            t[i] = arguments[i];
        return !t.some(function (e) {
            return !(e && "function" == typeof e.getBoundingClientRect);
        });
    }
    function Wt(e) {
        void 0 === e && (e = {});
        var t = e,
            i = t.defaultModifiers,
            n = void 0 === i ? [] : i,
            s = t.defaultOptions,
            a = void 0 === s ? Ht : s;
        return function (e, t, i) {
            void 0 === i && (i = a);
            var s,
                r,
                o = {
                    placement: "bottom",
                    orderedModifiers: [],
                    options: Object.assign({}, Ht, a),
                    modifiersData: {},
                    elements: { reference: e, popper: t },
                    attributes: {},
                    styles: {},
                },
                l = [],
                u = !1,
                d = {
                    state: o,
                    setOptions: function (i) {
                        var s = "function" == typeof i ? i(o.options) : i;
                        c(),
                            (o.options = Object.assign({}, a, o.options, s)),
                            (o.scrollParents = {
                                reference: We(e)
                                    ? Mt(e)
                                    : e.contextElement
                                    ? Mt(e.contextElement)
                                    : [],
                                popper: Mt(t),
                            });
                        var r,
                            u,
                            h = (function (e) {
                                var t = Ft(e);
                                return Fe.reduce(function (e, i) {
                                    return e.concat(
                                        t.filter(function (e) {
                                            return e.phase === i;
                                        })
                                    );
                                }, []);
                            })(
                                ((r = [].concat(n, o.options.modifiers)),
                                (u = r.reduce(function (e, t) {
                                    var i = e[t.name];
                                    return (
                                        (e[t.name] = i
                                            ? Object.assign({}, i, t, {
                                                  options: Object.assign(
                                                      {},
                                                      i.options,
                                                      t.options
                                                  ),
                                                  data: Object.assign(
                                                      {},
                                                      i.data,
                                                      t.data
                                                  ),
                                              })
                                            : t),
                                        e
                                    );
                                }, {})),
                                Object.keys(u).map(function (e) {
                                    return u[e];
                                }))
                            );
                        return (
                            (o.orderedModifiers = h.filter(function (e) {
                                return e.enabled;
                            })),
                            o.orderedModifiers.forEach(function (e) {
                                var t = e.name,
                                    i = e.options,
                                    n = void 0 === i ? {} : i,
                                    s = e.effect;
                                if ("function" == typeof s) {
                                    var a = s({
                                            state: o,
                                            name: t,
                                            instance: d,
                                            options: n,
                                        }),
                                        r = function () {};
                                    l.push(a || r);
                                }
                            }),
                            d.update()
                        );
                    },
                    forceUpdate: function () {
                        if (!u) {
                            var e = o.elements,
                                t = e.reference,
                                i = e.popper;
                            if (jt(t, i)) {
                                (o.rects = {
                                    reference: $t(
                                        t,
                                        tt(i),
                                        "fixed" === o.options.strategy
                                    ),
                                    popper: Xe(i),
                                }),
                                    (o.reset = !1),
                                    (o.placement = o.options.placement),
                                    o.orderedModifiers.forEach(function (e) {
                                        return (o.modifiersData[e.name] =
                                            Object.assign({}, e.data));
                                    });
                                for (
                                    var n = 0;
                                    n < o.orderedModifiers.length;
                                    n++
                                )
                                    if (!0 !== o.reset) {
                                        var s = o.orderedModifiers[n],
                                            a = s.fn,
                                            r = s.options,
                                            l = void 0 === r ? {} : r,
                                            c = s.name;
                                        "function" == typeof a &&
                                            (o =
                                                a({
                                                    state: o,
                                                    options: l,
                                                    name: c,
                                                    instance: d,
                                                }) || o);
                                    } else (o.reset = !1), (n = -1);
                            }
                        }
                    },
                    update:
                        ((s = function () {
                            return new Promise(function (e) {
                                d.forceUpdate(), e(o);
                            });
                        }),
                        function () {
                            return (
                                r ||
                                    (r = new Promise(function (e) {
                                        Promise.resolve().then(function () {
                                            (r = void 0), e(s());
                                        });
                                    })),
                                r
                            );
                        }),
                    destroy: function () {
                        c(), (u = !0);
                    },
                };
            if (!jt(e, t)) return d;
            function c() {
                l.forEach(function (e) {
                    return e();
                }),
                    (l = []);
            }
            return (
                d.setOptions(i).then(function (e) {
                    !u && i.onFirstUpdate && i.onFirstUpdate(e);
                }),
                d
            );
        };
    }
    var Yt = Wt(),
        Bt = Wt({ defaultModifiers: [mt, Rt, ft, Ve] }),
        Vt = Wt({ defaultModifiers: [mt, Rt, ft, Ve, It, Lt, zt, ut, Nt] });
    const qt = Object.freeze({
            __proto__: null,
            popperGenerator: Wt,
            detectOverflow: At,
            createPopperBase: Yt,
            createPopper: Vt,
            createPopperLite: Bt,
            top: ge,
            bottom: ve,
            right: ye,
            left: be,
            auto: _e,
            basePlacements: xe,
            start: we,
            end: Se,
            clippingParents: Me,
            viewport: Ee,
            popper: ke,
            reference: Te,
            variationPlacements: Ce,
            placements: Ae,
            beforeRead: Pe,
            read: Le,
            afterRead: De,
            beforeMain: Oe,
            main: Ne,
            afterMain: Ie,
            beforeWrite: Re,
            write: ze,
            afterWrite: $e,
            modifierPhases: Fe,
            applyStyles: Ve,
            arrow: ut,
            computeStyles: ft,
            eventListeners: mt,
            flip: Lt,
            hide: Nt,
            offset: It,
            popperOffsets: Rt,
            preventOverflow: zt,
        }),
        Ut = "dropdown",
        Xt = "Escape",
        Gt = "Space",
        Kt = "ArrowUp",
        Qt = "ArrowDown",
        Zt = new RegExp("ArrowUp|ArrowDown|Escape"),
        Jt = "click.bs.dropdown.data-api",
        ei = "keydown.bs.dropdown.data-api",
        ti = "show",
        ii = '[data-bs-toggle="dropdown"]',
        ni = ".dropdown-menu",
        si = m() ? "top-end" : "top-start",
        ai = m() ? "top-start" : "top-end",
        ri = m() ? "bottom-end" : "bottom-start",
        oi = m() ? "bottom-start" : "bottom-end",
        li = m() ? "left-start" : "right-start",
        ui = m() ? "right-start" : "left-start",
        di = {
            offset: [0, 2],
            boundary: "clippingParents",
            reference: "toggle",
            display: "dynamic",
            popperConfig: null,
            autoClose: !0,
        },
        ci = {
            offset: "(array|string|function)",
            boundary: "(string|element)",
            reference: "(string|element|object)",
            display: "string",
            popperConfig: "(null|object|function)",
            autoClose: "(boolean|string)",
        };
    class hi extends $ {
        constructor(e, t) {
            super(e),
                (this._popper = null),
                (this._config = this._getConfig(t)),
                (this._menu = this._getMenuElement()),
                (this._inNavbar = this._detectNavbar());
        }
        static get Default() {
            return di;
        }
        static get DefaultType() {
            return ci;
        }
        static get NAME() {
            return Ut;
        }
        toggle() {
            return this._isShown() ? this.hide() : this.show();
        }
        show() {
            if (u(this._element) || this._isShown(this._menu)) return;
            const e = { relatedTarget: this._element };
            if (
                I.trigger(this._element, "show.bs.dropdown", e).defaultPrevented
            )
                return;
            const t = hi.getParentFromElement(this._element);
            this._inNavbar
                ? V.setDataAttribute(this._menu, "popper", "none")
                : this._createPopper(t),
                "ontouchstart" in document.documentElement &&
                    !t.closest(".navbar-nav") &&
                    []
                        .concat(...document.body.children)
                        .forEach((e) => I.on(e, "mouseover", c)),
                this._element.focus(),
                this._element.setAttribute("aria-expanded", !0),
                this._menu.classList.add(ti),
                this._element.classList.add(ti),
                I.trigger(this._element, "shown.bs.dropdown", e);
        }
        hide() {
            if (u(this._element) || !this._isShown(this._menu)) return;
            const e = { relatedTarget: this._element };
            this._completeHide(e);
        }
        dispose() {
            this._popper && this._popper.destroy(), super.dispose();
        }
        update() {
            (this._inNavbar = this._detectNavbar()),
                this._popper && this._popper.update();
        }
        _completeHide(e) {
            I.trigger(this._element, "hide.bs.dropdown", e).defaultPrevented ||
                ("ontouchstart" in document.documentElement &&
                    []
                        .concat(...document.body.children)
                        .forEach((e) => I.off(e, "mouseover", c)),
                this._popper && this._popper.destroy(),
                this._menu.classList.remove(ti),
                this._element.classList.remove(ti),
                this._element.setAttribute("aria-expanded", "false"),
                V.removeDataAttribute(this._menu, "popper"),
                I.trigger(this._element, "hidden.bs.dropdown", e));
        }
        _getConfig(e) {
            if (
                ((e = {
                    ...this.constructor.Default,
                    ...V.getDataAttributes(this._element),
                    ...e,
                }),
                o(Ut, e, this.constructor.DefaultType),
                "object" == typeof e.reference &&
                    !a(e.reference) &&
                    "function" != typeof e.reference.getBoundingClientRect)
            )
                throw new TypeError(
                    `${Ut.toUpperCase()}: Option "reference" provided type "object" without a required "getBoundingClientRect" method.`
                );
            return e;
        }
        _createPopper(e) {
            if (void 0 === qt)
                throw new TypeError(
                    "Bootstrap's dropdowns require Popper (https://popper.js.org)"
                );
            let t = this._element;
            "parent" === this._config.reference
                ? (t = e)
                : a(this._config.reference)
                ? (t = r(this._config.reference))
                : "object" == typeof this._config.reference &&
                  (t = this._config.reference);
            const i = this._getPopperConfig(),
                n = i.modifiers.find(
                    (e) => "applyStyles" === e.name && !1 === e.enabled
                );
            (this._popper = Vt(t, this._menu, i)),
                n && V.setDataAttribute(this._menu, "popper", "static");
        }
        _isShown(e = this._element) {
            return e.classList.contains(ti);
        }
        _getMenuElement() {
            return q.next(this._element, ni)[0];
        }
        _getPlacement() {
            const e = this._element.parentNode;
            if (e.classList.contains("dropend")) return li;
            if (e.classList.contains("dropstart")) return ui;
            const t =
                "end" ===
                getComputedStyle(this._menu)
                    .getPropertyValue("--bs-position")
                    .trim();
            return e.classList.contains("dropup") ? (t ? ai : si) : t ? oi : ri;
        }
        _detectNavbar() {
            return null !== this._element.closest(".navbar");
        }
        _getOffset() {
            const { offset: e } = this._config;
            return "string" == typeof e
                ? e.split(",").map((e) => Number.parseInt(e, 10))
                : "function" == typeof e
                ? (t) => e(t, this._element)
                : e;
        }
        _getPopperConfig() {
            const e = {
                placement: this._getPlacement(),
                modifiers: [
                    {
                        name: "preventOverflow",
                        options: { boundary: this._config.boundary },
                    },
                    {
                        name: "offset",
                        options: { offset: this._getOffset() },
                    },
                ],
            };
            return (
                "static" === this._config.display &&
                    (e.modifiers = [{ name: "applyStyles", enabled: !1 }]),
                {
                    ...e,
                    ...("function" == typeof this._config.popperConfig
                        ? this._config.popperConfig(e)
                        : this._config.popperConfig),
                }
            );
        }
        _selectMenuItem({ key: e, target: t }) {
            const i = q
                .find(
                    ".dropdown-menu .dropdown-item:not(.disabled):not(:disabled)",
                    this._menu
                )
                .filter(l);
            i.length && b(i, t, e === Qt, !i.includes(t)).focus();
        }
        static jQueryInterface(e) {
            return this.each(function () {
                const t = hi.getOrCreateInstance(this, e);
                if ("string" == typeof e) {
                    if (void 0 === t[e])
                        throw new TypeError(`No method named "${e}"`);
                    t[e]();
                }
            });
        }
        static clearMenus(e) {
            if (
                e &&
                (2 === e.button || ("keyup" === e.type && "Tab" !== e.key))
            )
                return;
            const t = q.find(ii);
            for (let i = 0, n = t.length; i < n; i++) {
                const n = hi.getInstance(t[i]);
                if (!n || !1 === n._config.autoClose) continue;
                if (!n._isShown()) continue;
                const s = { relatedTarget: n._element };
                if (e) {
                    const t = e.composedPath(),
                        i = t.includes(n._menu);
                    if (
                        t.includes(n._element) ||
                        ("inside" === n._config.autoClose && !i) ||
                        ("outside" === n._config.autoClose && i)
                    )
                        continue;
                    if (
                        n._menu.contains(e.target) &&
                        (("keyup" === e.type && "Tab" === e.key) ||
                            /input|select|option|textarea|form/i.test(
                                e.target.tagName
                            ))
                    )
                        continue;
                    "click" === e.type && (s.clickEvent = e);
                }
                n._completeHide(s);
            }
        }
        static getParentFromElement(e) {
            return n(e) || e.parentNode;
        }
        static dataApiKeydownHandler(e) {
            if (
                /input|textarea/i.test(e.target.tagName)
                    ? e.key === Gt ||
                      (e.key !== Xt &&
                          ((e.key !== Qt && e.key !== Kt) ||
                              e.target.closest(ni)))
                    : !Zt.test(e.key)
            )
                return;
            const t = this.classList.contains(ti);
            if (!t && e.key === Xt) return;
            if ((e.preventDefault(), e.stopPropagation(), u(this))) return;
            const i = this.matches(ii) ? this : q.prev(this, ii)[0],
                n = hi.getOrCreateInstance(i);
            if (e.key !== Xt)
                return e.key === Kt || e.key === Qt
                    ? (t || n.show(), void n._selectMenuItem(e))
                    : void ((t && e.key !== Gt) || hi.clearMenus());
            n.hide();
        }
    }
    I.on(document, ei, ii, hi.dataApiKeydownHandler),
        I.on(document, ei, ni, hi.dataApiKeydownHandler),
        I.on(document, Jt, hi.clearMenus),
        I.on(document, "keyup.bs.dropdown.data-api", hi.clearMenus),
        I.on(document, Jt, ii, function (e) {
            e.preventDefault(), hi.getOrCreateInstance(this).toggle();
        }),
        g(hi);
    const fi = ".fixed-top, .fixed-bottom, .is-fixed, .sticky-top",
        pi = ".sticky-top";
    class mi {
        constructor() {
            this._element = document.body;
        }
        getWidth() {
            const e = document.documentElement.clientWidth;
            return Math.abs(window.innerWidth - e);
        }
        hide() {
            const e = this.getWidth();
            this._disableOverFlow(),
                this._setElementAttributes(
                    this._element,
                    "paddingRight",
                    (t) => t + e
                ),
                this._setElementAttributes(fi, "paddingRight", (t) => t + e),
                this._setElementAttributes(pi, "marginRight", (t) => t - e);
        }
        _disableOverFlow() {
            this._saveInitialAttribute(this._element, "overflow"),
                (this._element.style.overflow = "hidden");
        }
        _setElementAttributes(e, t, i) {
            const n = this.getWidth();
            this._applyManipulationCallback(e, (e) => {
                if (
                    e !== this._element &&
                    window.innerWidth > e.clientWidth + n
                )
                    return;
                this._saveInitialAttribute(e, t);
                const s = window.getComputedStyle(e)[t];
                e.style[t] = `${i(Number.parseFloat(s))}px`;
            });
        }
        reset() {
            this._resetElementAttributes(this._element, "overflow"),
                this._resetElementAttributes(this._element, "paddingRight"),
                this._resetElementAttributes(fi, "paddingRight"),
                this._resetElementAttributes(pi, "marginRight");
        }
        _saveInitialAttribute(e, t) {
            const i = e.style[t];
            i && V.setDataAttribute(e, t, i);
        }
        _resetElementAttributes(e, t) {
            this._applyManipulationCallback(e, (e) => {
                const i = V.getDataAttribute(e, t);
                void 0 === i
                    ? e.style.removeProperty(t)
                    : (V.removeDataAttribute(e, t), (e.style[t] = i));
            });
        }
        _applyManipulationCallback(e, t) {
            a(e) ? t(e) : q.find(e, this._element).forEach(t);
        }
        isOverflowing() {
            return this.getWidth() > 0;
        }
    }
    const gi = {
            className: "modal-backdrop",
            isVisible: !0,
            isAnimated: !1,
            rootElement: "body",
            clickCallback: null,
        },
        vi = {
            className: "string",
            isVisible: "boolean",
            isAnimated: "boolean",
            rootElement: "(element|string)",
            clickCallback: "(function|null)",
        },
        yi = "backdrop",
        bi = "show",
        _i = "mousedown.bs.backdrop";
    class xi {
        constructor(e) {
            (this._config = this._getConfig(e)),
                (this._isAppended = !1),
                (this._element = null);
        }
        show(e) {
            this._config.isVisible
                ? (this._append(),
                  this._config.isAnimated && h(this._getElement()),
                  this._getElement().classList.add(bi),
                  this._emulateAnimation(() => {
                      v(e);
                  }))
                : v(e);
        }
        hide(e) {
            this._config.isVisible
                ? (this._getElement().classList.remove(bi),
                  this._emulateAnimation(() => {
                      this.dispose(), v(e);
                  }))
                : v(e);
        }
        _getElement() {
            if (!this._element) {
                const e = document.createElement("div");
                (e.className = this._config.className),
                    this._config.isAnimated && e.classList.add("fade"),
                    (this._element = e);
            }
            return this._element;
        }
        _getConfig(e) {
            return (
                ((e = {
                    ...gi,
                    ...("object" == typeof e ? e : {}),
                }).rootElement = r(e.rootElement)),
                o(yi, e, vi),
                e
            );
        }
        _append() {
            this._isAppended ||
                (this._config.rootElement.append(this._getElement()),
                I.on(this._getElement(), _i, () => {
                    v(this._config.clickCallback);
                }),
                (this._isAppended = !0));
        }
        dispose() {
            this._isAppended &&
                (I.off(this._element, _i),
                this._element.remove(),
                (this._isAppended = !1));
        }
        _emulateAnimation(e) {
            y(e, this._getElement(), this._config.isAnimated);
        }
    }
    const wi = { trapElement: null, autofocus: !0 },
        Si = { trapElement: "element", autofocus: "boolean" },
        Mi = ".bs.focustrap",
        Ei = "backward";
    class ki {
        constructor(e) {
            (this._config = this._getConfig(e)),
                (this._isActive = !1),
                (this._lastTabNavDirection = null);
        }
        activate() {
            const { trapElement: e, autofocus: t } = this._config;
            this._isActive ||
                (t && e.focus(),
                I.off(document, Mi),
                I.on(document, "focusin.bs.focustrap", (e) =>
                    this._handleFocusin(e)
                ),
                I.on(document, "keydown.tab.bs.focustrap", (e) =>
                    this._handleKeydown(e)
                ),
                (this._isActive = !0));
        }
        deactivate() {
            this._isActive && ((this._isActive = !1), I.off(document, Mi));
        }
        _handleFocusin(e) {
            const { target: t } = e,
                { trapElement: i } = this._config;
            if (t === document || t === i || i.contains(t)) return;
            const n = q.focusableChildren(i);
            0 === n.length
                ? i.focus()
                : this._lastTabNavDirection === Ei
                ? n[n.length - 1].focus()
                : n[0].focus();
        }
        _handleKeydown(e) {
            "Tab" === e.key &&
                (this._lastTabNavDirection = e.shiftKey ? Ei : "forward");
        }
        _getConfig(e) {
            return (
                (e = { ...wi, ...("object" == typeof e ? e : {}) }),
                o("focustrap", e, Si),
                e
            );
        }
    }
    const Ti = "modal",
        Ci = ".bs.modal",
        Ai = "Escape",
        Pi = { backdrop: !0, keyboard: !0, focus: !0 },
        Li = {
            backdrop: "(boolean|string)",
            keyboard: "boolean",
            focus: "boolean",
        },
        Di = "hidden.bs.modal",
        Oi = "show.bs.modal",
        Ni = "resize.bs.modal",
        Ii = "click.dismiss.bs.modal",
        Ri = "keydown.dismiss.bs.modal",
        zi = "mousedown.dismiss.bs.modal",
        $i = "modal-open",
        Fi = "show",
        Hi = "modal-static";
    class ji extends $ {
        constructor(e, t) {
            super(e),
                (this._config = this._getConfig(t)),
                (this._dialog = q.findOne(".modal-dialog", this._element)),
                (this._backdrop = this._initializeBackDrop()),
                (this._focustrap = this._initializeFocusTrap()),
                (this._isShown = !1),
                (this._ignoreBackdropClick = !1),
                (this._isTransitioning = !1),
                (this._scrollBar = new mi());
        }
        static get Default() {
            return Pi;
        }
        static get NAME() {
            return Ti;
        }
        toggle(e) {
            return this._isShown ? this.hide() : this.show(e);
        }
        show(e) {
            if (this._isShown || this._isTransitioning) return;
            I.trigger(this._element, Oi, { relatedTarget: e })
                .defaultPrevented ||
                ((this._isShown = !0),
                this._isAnimated() && (this._isTransitioning = !0),
                this._scrollBar.hide(),
                document.body.classList.add($i),
                this._adjustDialog(),
                this._setEscapeEvent(),
                this._setResizeEvent(),
                I.on(this._dialog, zi, () => {
                    I.one(this._element, "mouseup.dismiss.bs.modal", (e) => {
                        e.target === this._element &&
                            (this._ignoreBackdropClick = !0);
                    });
                }),
                this._showBackdrop(() => this._showElement(e)));
        }
        hide() {
            if (!this._isShown || this._isTransitioning) return;
            if (I.trigger(this._element, "hide.bs.modal").defaultPrevented)
                return;
            this._isShown = !1;
            const e = this._isAnimated();
            e && (this._isTransitioning = !0),
                this._setEscapeEvent(),
                this._setResizeEvent(),
                this._focustrap.deactivate(),
                this._element.classList.remove(Fi),
                I.off(this._element, Ii),
                I.off(this._dialog, zi),
                this._queueCallback(() => this._hideModal(), this._element, e);
        }
        dispose() {
            [window, this._dialog].forEach((e) => I.off(e, Ci)),
                this._backdrop.dispose(),
                this._focustrap.deactivate(),
                super.dispose();
        }
        handleUpdate() {
            this._adjustDialog();
        }
        _initializeBackDrop() {
            return new xi({
                isVisible: Boolean(this._config.backdrop),
                isAnimated: this._isAnimated(),
            });
        }
        _initializeFocusTrap() {
            return new ki({ trapElement: this._element });
        }
        _getConfig(e) {
            return (
                (e = {
                    ...Pi,
                    ...V.getDataAttributes(this._element),
                    ...("object" == typeof e ? e : {}),
                }),
                o(Ti, e, Li),
                e
            );
        }
        _showElement(e) {
            const t = this._isAnimated(),
                i = q.findOne(".modal-body", this._dialog);
            (this._element.parentNode &&
                this._element.parentNode.nodeType === Node.ELEMENT_NODE) ||
                document.body.append(this._element),
                (this._element.style.display = "block"),
                this._element.removeAttribute("aria-hidden"),
                this._element.setAttribute("aria-modal", !0),
                this._element.setAttribute("role", "dialog"),
                (this._element.scrollTop = 0),
                i && (i.scrollTop = 0),
                t && h(this._element),
                this._element.classList.add(Fi);
            this._queueCallback(
                () => {
                    this._config.focus && this._focustrap.activate(),
                        (this._isTransitioning = !1),
                        I.trigger(this._element, "shown.bs.modal", {
                            relatedTarget: e,
                        });
                },
                this._dialog,
                t
            );
        }
        _setEscapeEvent() {
            this._isShown
                ? I.on(this._element, Ri, (e) => {
                      this._config.keyboard && e.key === Ai
                          ? (e.preventDefault(), this.hide())
                          : this._config.keyboard ||
                            e.key !== Ai ||
                            this._triggerBackdropTransition();
                  })
                : I.off(this._element, Ri);
        }
        _setResizeEvent() {
            this._isShown
                ? I.on(window, Ni, () => this._adjustDialog())
                : I.off(window, Ni);
        }
        _hideModal() {
            (this._element.style.display = "none"),
                this._element.setAttribute("aria-hidden", !0),
                this._element.removeAttribute("aria-modal"),
                this._element.removeAttribute("role"),
                (this._isTransitioning = !1),
                this._backdrop.hide(() => {
                    document.body.classList.remove($i),
                        this._resetAdjustments(),
                        this._scrollBar.reset(),
                        I.trigger(this._element, Di);
                });
        }
        _showBackdrop(e) {
            I.on(this._element, Ii, (e) => {
                this._ignoreBackdropClick
                    ? (this._ignoreBackdropClick = !1)
                    : e.target === e.currentTarget &&
                      (!0 === this._config.backdrop
                          ? this.hide()
                          : "static" === this._config.backdrop &&
                            this._triggerBackdropTransition());
            }),
                this._backdrop.show(e);
        }
        _isAnimated() {
            return this._element.classList.contains("fade");
        }
        _triggerBackdropTransition() {
            if (
                I.trigger(this._element, "hidePrevented.bs.modal")
                    .defaultPrevented
            )
                return;
            const { classList: e, scrollHeight: t, style: i } = this._element,
                n = t > document.documentElement.clientHeight;
            (!n && "hidden" === i.overflowY) ||
                e.contains(Hi) ||
                (n || (i.overflowY = "hidden"),
                e.add(Hi),
                this._queueCallback(() => {
                    e.remove(Hi),
                        n ||
                            this._queueCallback(() => {
                                i.overflowY = "";
                            }, this._dialog);
                }, this._dialog),
                this._element.focus());
        }
        _adjustDialog() {
            const e =
                    this._element.scrollHeight >
                    document.documentElement.clientHeight,
                t = this._scrollBar.getWidth(),
                i = t > 0;
            ((!i && e && !m()) || (i && !e && m())) &&
                (this._element.style.paddingLeft = `${t}px`),
                ((i && !e && !m()) || (!i && e && m())) &&
                    (this._element.style.paddingRight = `${t}px`);
        }
        _resetAdjustments() {
            (this._element.style.paddingLeft = ""),
                (this._element.style.paddingRight = "");
        }
        static jQueryInterface(e, t) {
            return this.each(function () {
                const i = ji.getOrCreateInstance(this, e);
                if ("string" == typeof e) {
                    if (void 0 === i[e])
                        throw new TypeError(`No method named "${e}"`);
                    i[e](t);
                }
            });
        }
    }
    I.on(
        document,
        "click.bs.modal.data-api",
        '[data-bs-toggle="modal"]',
        function (e) {
            const t = n(this);
            ["A", "AREA"].includes(this.tagName) && e.preventDefault(),
                I.one(t, Oi, (e) => {
                    e.defaultPrevented ||
                        I.one(t, Di, () => {
                            l(this) && this.focus();
                        });
                });
            const i = q.findOne(".modal.show");
            i && ji.getInstance(i).hide();
            ji.getOrCreateInstance(t).toggle(this);
        }
    ),
        F(ji),
        g(ji);
    const Wi = "offcanvas",
        Yi = { backdrop: !0, keyboard: !0, scroll: !1 },
        Bi = {
            backdrop: "boolean",
            keyboard: "boolean",
            scroll: "boolean",
        },
        Vi = "show",
        qi = ".offcanvas.show",
        Ui = "hidden.bs.offcanvas";
    class Xi extends $ {
        constructor(e, t) {
            super(e),
                (this._config = this._getConfig(t)),
                (this._isShown = !1),
                (this._backdrop = this._initializeBackDrop()),
                (this._focustrap = this._initializeFocusTrap()),
                this._addEventListeners();
        }
        static get NAME() {
            return Wi;
        }
        static get Default() {
            return Yi;
        }
        toggle(e) {
            return this._isShown ? this.hide() : this.show(e);
        }
        show(e) {
            if (this._isShown) return;
            if (
                I.trigger(this._element, "show.bs.offcanvas", {
                    relatedTarget: e,
                }).defaultPrevented
            )
                return;
            (this._isShown = !0),
                (this._element.style.visibility = "visible"),
                this._backdrop.show(),
                this._config.scroll || new mi().hide(),
                this._element.removeAttribute("aria-hidden"),
                this._element.setAttribute("aria-modal", !0),
                this._element.setAttribute("role", "dialog"),
                this._element.classList.add(Vi);
            this._queueCallback(
                () => {
                    this._config.scroll || this._focustrap.activate(),
                        I.trigger(this._element, "shown.bs.offcanvas", {
                            relatedTarget: e,
                        });
                },
                this._element,
                !0
            );
        }
        hide() {
            if (!this._isShown) return;
            if (I.trigger(this._element, "hide.bs.offcanvas").defaultPrevented)
                return;
            this._focustrap.deactivate(),
                this._element.blur(),
                (this._isShown = !1),
                this._element.classList.remove(Vi),
                this._backdrop.hide();
            this._queueCallback(
                () => {
                    this._element.setAttribute("aria-hidden", !0),
                        this._element.removeAttribute("aria-modal"),
                        this._element.removeAttribute("role"),
                        (this._element.style.visibility = "hidden"),
                        this._config.scroll || new mi().reset(),
                        I.trigger(this._element, Ui);
                },
                this._element,
                !0
            );
        }
        dispose() {
            this._backdrop.dispose(),
                this._focustrap.deactivate(),
                super.dispose();
        }
        _getConfig(e) {
            return (
                (e = {
                    ...Yi,
                    ...V.getDataAttributes(this._element),
                    ...("object" == typeof e ? e : {}),
                }),
                o(Wi, e, Bi),
                e
            );
        }
        _initializeBackDrop() {
            return new xi({
                className: "offcanvas-backdrop",
                isVisible: this._config.backdrop,
                isAnimated: !0,
                rootElement: this._element.parentNode,
                clickCallback: () => this.hide(),
            });
        }
        _initializeFocusTrap() {
            return new ki({ trapElement: this._element });
        }
        _addEventListeners() {
            I.on(this._element, "keydown.dismiss.bs.offcanvas", (e) => {
                this._config.keyboard && "Escape" === e.key && this.hide();
            });
        }
        static jQueryInterface(e) {
            return this.each(function () {
                const t = Xi.getOrCreateInstance(this, e);
                if ("string" == typeof e) {
                    if (
                        void 0 === t[e] ||
                        e.startsWith("_") ||
                        "constructor" === e
                    )
                        throw new TypeError(`No method named "${e}"`);
                    t[e](this);
                }
            });
        }
    }
    I.on(
        document,
        "click.bs.offcanvas.data-api",
        '[data-bs-toggle="offcanvas"]',
        function (e) {
            const t = n(this);
            if (
                (["A", "AREA"].includes(this.tagName) && e.preventDefault(),
                u(this))
            )
                return;
            I.one(t, Ui, () => {
                l(this) && this.focus();
            });
            const i = q.findOne(qi);
            i && i !== t && Xi.getInstance(i).hide();
            Xi.getOrCreateInstance(t).toggle(this);
        }
    ),
        I.on(window, "load.bs.offcanvas.data-api", () =>
            q.find(qi).forEach((e) => Xi.getOrCreateInstance(e).show())
        ),
        F(Xi),
        g(Xi);
    const Gi = new Set([
            "background",
            "cite",
            "href",
            "itemtype",
            "longdesc",
            "poster",
            "src",
            "xlink:href",
        ]),
        Ki = /^(?:(?:https?|mailto|ftp|tel|file|sms):|[^#&/:?]*(?:[#/?]|$))/i,
        Qi =
            /^data:(?:image\/(?:bmp|gif|jpeg|jpg|png|tiff|webp)|video\/(?:mpeg|mp4|ogg|webm)|audio\/(?:mp3|oga|ogg|opus));base64,[\d+/a-z]+=*$/i,
        Zi = (e, t) => {
            const i = e.nodeName.toLowerCase();
            if (t.includes(i))
                return (
                    !Gi.has(i) ||
                    Boolean(Ki.test(e.nodeValue) || Qi.test(e.nodeValue))
                );
            const n = t.filter((e) => e instanceof RegExp);
            for (let e = 0, t = n.length; e < t; e++)
                if (n[e].test(i)) return !0;
            return !1;
        },
        Ji = {
            "*": ["class", "dir", "id", "lang", "role", /^aria-[\w-]*$/i],
            a: ["target", "href", "title", "rel"],
            area: [],
            b: [],
            br: [],
            col: [],
            code: [],
            div: [],
            em: [],
            hr: [],
            h1: [],
            h2: [],
            h3: [],
            h4: [],
            h5: [],
            h6: [],
            i: [],
            img: ["src", "srcset", "alt", "title", "width", "height"],
            li: [],
            ol: [],
            p: [],
            pre: [],
            s: [],
            small: [],
            span: [],
            sub: [],
            sup: [],
            strong: [],
            u: [],
            ul: [],
        };
    function en(e, t, i) {
        if (!e.length) return e;
        if (i && "function" == typeof i) return i(e);
        const n = new window.DOMParser().parseFromString(e, "text/html"),
            s = [].concat(...n.body.querySelectorAll("*"));
        for (let e = 0, i = s.length; e < i; e++) {
            const i = s[e],
                n = i.nodeName.toLowerCase();
            if (!Object.keys(t).includes(n)) {
                i.remove();
                continue;
            }
            const a = [].concat(...i.attributes),
                r = [].concat(t["*"] || [], t[n] || []);
            a.forEach((e) => {
                Zi(e, r) || i.removeAttribute(e.nodeName);
            });
        }
        return n.body.innerHTML;
    }
    const tn = "tooltip",
        nn = new Set(["sanitize", "allowList", "sanitizeFn"]),
        sn = {
            animation: "boolean",
            template: "string",
            title: "(string|element|function)",
            trigger: "string",
            delay: "(number|object)",
            html: "boolean",
            selector: "(string|boolean)",
            placement: "(string|function)",
            offset: "(array|string|function)",
            container: "(string|element|boolean)",
            fallbackPlacements: "array",
            boundary: "(string|element)",
            customClass: "(string|function)",
            sanitize: "boolean",
            sanitizeFn: "(null|function)",
            allowList: "object",
            popperConfig: "(null|object|function)",
        },
        an = {
            AUTO: "auto",
            TOP: "top",
            RIGHT: m() ? "left" : "right",
            BOTTOM: "bottom",
            LEFT: m() ? "right" : "left",
        },
        rn = {
            animation: !0,
            template:
                '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
            trigger: "hover focus",
            title: "",
            delay: 0,
            html: !1,
            selector: !1,
            placement: "top",
            offset: [0, 0],
            container: !1,
            fallbackPlacements: ["top", "right", "bottom", "left"],
            boundary: "clippingParents",
            customClass: "",
            sanitize: !0,
            sanitizeFn: null,
            allowList: Ji,
            popperConfig: null,
        },
        on = {
            HIDE: "hide.bs.tooltip",
            HIDDEN: "hidden.bs.tooltip",
            SHOW: "show.bs.tooltip",
            SHOWN: "shown.bs.tooltip",
            INSERTED: "inserted.bs.tooltip",
            CLICK: "click.bs.tooltip",
            FOCUSIN: "focusin.bs.tooltip",
            FOCUSOUT: "focusout.bs.tooltip",
            MOUSEENTER: "mouseenter.bs.tooltip",
            MOUSELEAVE: "mouseleave.bs.tooltip",
        },
        ln = "fade",
        un = "show",
        dn = "show",
        cn = "out",
        hn = ".tooltip-inner",
        fn = ".modal",
        pn = "hide.bs.modal",
        mn = "hover",
        gn = "focus";
    class vn extends $ {
        constructor(e, t) {
            if (void 0 === qt)
                throw new TypeError(
                    "Bootstrap's tooltips require Popper (https://popper.js.org)"
                );
            super(e),
                (this._isEnabled = !0),
                (this._timeout = 0),
                (this._hoverState = ""),
                (this._activeTrigger = {}),
                (this._popper = null),
                (this._config = this._getConfig(t)),
                (this.tip = null),
                this._setListeners();
        }
        static get Default() {
            return rn;
        }
        static get NAME() {
            return tn;
        }
        static get Event() {
            return on;
        }
        static get DefaultType() {
            return sn;
        }
        enable() {
            this._isEnabled = !0;
        }
        disable() {
            this._isEnabled = !1;
        }
        toggleEnabled() {
            this._isEnabled = !this._isEnabled;
        }
        toggle(e) {
            if (this._isEnabled)
                if (e) {
                    const t = this._initializeOnDelegatedTarget(e);
                    (t._activeTrigger.click = !t._activeTrigger.click),
                        t._isWithActiveTrigger()
                            ? t._enter(null, t)
                            : t._leave(null, t);
                } else {
                    if (this.getTipElement().classList.contains(un))
                        return void this._leave(null, this);
                    this._enter(null, this);
                }
        }
        dispose() {
            clearTimeout(this._timeout),
                I.off(this._element.closest(fn), pn, this._hideModalHandler),
                this.tip && this.tip.remove(),
                this._disposePopper(),
                super.dispose();
        }
        show() {
            if ("none" === this._element.style.display)
                throw new Error("Please use show on visible elements");
            if (!this.isWithContent() || !this._isEnabled) return;
            const e = I.trigger(this._element, this.constructor.Event.SHOW),
                t = d(this._element),
                i =
                    null === t
                        ? this._element.ownerDocument.documentElement.contains(
                              this._element
                          )
                        : t.contains(this._element);
            if (e.defaultPrevented || !i) return;
            "tooltip" === this.constructor.NAME &&
                this.tip &&
                this.getTitle() !== this.tip.querySelector(hn).innerHTML &&
                (this._disposePopper(), this.tip.remove(), (this.tip = null));
            const n = this.getTipElement(),
                s = ((e) => {
                    do {
                        e += Math.floor(1e6 * Math.random());
                    } while (document.getElementById(e));
                    return e;
                })(this.constructor.NAME);
            n.setAttribute("id", s),
                this._element.setAttribute("aria-describedby", s),
                this._config.animation && n.classList.add(ln);
            const a =
                    "function" == typeof this._config.placement
                        ? this._config.placement.call(this, n, this._element)
                        : this._config.placement,
                r = this._getAttachment(a);
            this._addAttachmentClass(r);
            const { container: o } = this._config;
            z.set(n, this.constructor.DATA_KEY, this),
                this._element.ownerDocument.documentElement.contains(
                    this.tip
                ) ||
                    (o.append(n),
                    I.trigger(this._element, this.constructor.Event.INSERTED)),
                this._popper
                    ? this._popper.update()
                    : (this._popper = Vt(
                          this._element,
                          n,
                          this._getPopperConfig(r)
                      )),
                n.classList.add(un);
            const l = this._resolvePossibleFunction(this._config.customClass);
            l && n.classList.add(...l.split(" ")),
                "ontouchstart" in document.documentElement &&
                    [].concat(...document.body.children).forEach((e) => {
                        I.on(e, "mouseover", c);
                    });
            const u = this.tip.classList.contains(ln);
            this._queueCallback(
                () => {
                    const e = this._hoverState;
                    (this._hoverState = null),
                        I.trigger(this._element, this.constructor.Event.SHOWN),
                        e === cn && this._leave(null, this);
                },
                this.tip,
                u
            );
        }
        hide() {
            if (!this._popper) return;
            const e = this.getTipElement();
            if (
                I.trigger(this._element, this.constructor.Event.HIDE)
                    .defaultPrevented
            )
                return;
            e.classList.remove(un),
                "ontouchstart" in document.documentElement &&
                    []
                        .concat(...document.body.children)
                        .forEach((e) => I.off(e, "mouseover", c)),
                (this._activeTrigger.click = !1),
                (this._activeTrigger.focus = !1),
                (this._activeTrigger.hover = !1);
            const t = this.tip.classList.contains(ln);
            this._queueCallback(
                () => {
                    this._isWithActiveTrigger() ||
                        (this._hoverState !== dn && e.remove(),
                        this._cleanTipClass(),
                        this._element.removeAttribute("aria-describedby"),
                        I.trigger(this._element, this.constructor.Event.HIDDEN),
                        this._disposePopper());
                },
                this.tip,
                t
            ),
                (this._hoverState = "");
        }
        update() {
            null !== this._popper && this._popper.update();
        }
        isWithContent() {
            return Boolean(this.getTitle());
        }
        getTipElement() {
            if (this.tip) return this.tip;
            const e = document.createElement("div");
            e.innerHTML = this._config.template;
            const t = e.children[0];
            return (
                this.setContent(t),
                t.classList.remove(ln, un),
                (this.tip = t),
                this.tip
            );
        }
        setContent(e) {
            this._sanitizeAndSetContent(e, this.getTitle(), hn);
        }
        _sanitizeAndSetContent(e, t, i) {
            const n = q.findOne(i, e);
            t || !n ? this.setElementContent(n, t) : n.remove();
        }
        setElementContent(e, t) {
            if (null !== e)
                return a(t)
                    ? ((t = r(t)),
                      void (this._config.html
                          ? t.parentNode !== e &&
                            ((e.innerHTML = ""), e.append(t))
                          : (e.textContent = t.textContent)))
                    : void (this._config.html
                          ? (this._config.sanitize &&
                                (t = en(
                                    t,
                                    this._config.allowList,
                                    this._config.sanitizeFn
                                )),
                            (e.innerHTML = t))
                          : (e.textContent = t));
        }
        getTitle() {
            const e =
                this._element.getAttribute("data-bs-original-title") ||
                this._config.title;
            return this._resolvePossibleFunction(e);
        }
        updateAttachment(e) {
            return "right" === e ? "end" : "left" === e ? "start" : e;
        }
        _initializeOnDelegatedTarget(e, t) {
            return (
                t ||
                this.constructor.getOrCreateInstance(
                    e.delegateTarget,
                    this._getDelegateConfig()
                )
            );
        }
        _getOffset() {
            const { offset: e } = this._config;
            return "string" == typeof e
                ? e.split(",").map((e) => Number.parseInt(e, 10))
                : "function" == typeof e
                ? (t) => e(t, this._element)
                : e;
        }
        _resolvePossibleFunction(e) {
            return "function" == typeof e ? e.call(this._element) : e;
        }
        _getPopperConfig(e) {
            const t = {
                placement: e,
                modifiers: [
                    {
                        name: "flip",
                        options: {
                            fallbackPlacements: this._config.fallbackPlacements,
                        },
                    },
                    {
                        name: "offset",
                        options: { offset: this._getOffset() },
                    },
                    {
                        name: "preventOverflow",
                        options: { boundary: this._config.boundary },
                    },
                    {
                        name: "arrow",
                        options: {
                            element: `.${this.constructor.NAME}-arrow`,
                        },
                    },
                    {
                        name: "onChange",
                        enabled: !0,
                        phase: "afterWrite",
                        fn: (e) => this._handlePopperPlacementChange(e),
                    },
                ],
                onFirstUpdate: (e) => {
                    e.options.placement !== e.placement &&
                        this._handlePopperPlacementChange(e);
                },
            };
            return {
                ...t,
                ...("function" == typeof this._config.popperConfig
                    ? this._config.popperConfig(t)
                    : this._config.popperConfig),
            };
        }
        _addAttachmentClass(e) {
            this.getTipElement().classList.add(
                `${this._getBasicClassPrefix()}-${this.updateAttachment(e)}`
            );
        }
        _getAttachment(e) {
            return an[e.toUpperCase()];
        }
        _setListeners() {
            this._config.trigger.split(" ").forEach((e) => {
                if ("click" === e)
                    I.on(
                        this._element,
                        this.constructor.Event.CLICK,
                        this._config.selector,
                        (e) => this.toggle(e)
                    );
                else if ("manual" !== e) {
                    const t =
                            e === mn
                                ? this.constructor.Event.MOUSEENTER
                                : this.constructor.Event.FOCUSIN,
                        i =
                            e === mn
                                ? this.constructor.Event.MOUSELEAVE
                                : this.constructor.Event.FOCUSOUT;
                    I.on(this._element, t, this._config.selector, (e) =>
                        this._enter(e)
                    ),
                        I.on(this._element, i, this._config.selector, (e) =>
                            this._leave(e)
                        );
                }
            }),
                (this._hideModalHandler = () => {
                    this._element && this.hide();
                }),
                I.on(this._element.closest(fn), pn, this._hideModalHandler),
                this._config.selector
                    ? (this._config = {
                          ...this._config,
                          trigger: "manual",
                          selector: "",
                      })
                    : this._fixTitle();
        }
        _fixTitle() {
            const e = this._element.getAttribute("title"),
                t = typeof this._element.getAttribute("data-bs-original-title");
            (e || "string" !== t) &&
                (this._element.setAttribute("data-bs-original-title", e || ""),
                !e ||
                    this._element.getAttribute("aria-label") ||
                    this._element.textContent ||
                    this._element.setAttribute("aria-label", e),
                this._element.setAttribute("title", ""));
        }
        _enter(e, t) {
            (t = this._initializeOnDelegatedTarget(e, t)),
                e && (t._activeTrigger["focusin" === e.type ? gn : mn] = !0),
                t.getTipElement().classList.contains(un) || t._hoverState === dn
                    ? (t._hoverState = dn)
                    : (clearTimeout(t._timeout),
                      (t._hoverState = dn),
                      t._config.delay && t._config.delay.show
                          ? (t._timeout = setTimeout(() => {
                                t._hoverState === dn && t.show();
                            }, t._config.delay.show))
                          : t.show());
        }
        _leave(e, t) {
            (t = this._initializeOnDelegatedTarget(e, t)),
                e &&
                    (t._activeTrigger["focusout" === e.type ? gn : mn] =
                        t._element.contains(e.relatedTarget)),
                t._isWithActiveTrigger() ||
                    (clearTimeout(t._timeout),
                    (t._hoverState = cn),
                    t._config.delay && t._config.delay.hide
                        ? (t._timeout = setTimeout(() => {
                              t._hoverState === cn && t.hide();
                          }, t._config.delay.hide))
                        : t.hide());
        }
        _isWithActiveTrigger() {
            for (const e in this._activeTrigger)
                if (this._activeTrigger[e]) return !0;
            return !1;
        }
        _getConfig(e) {
            const t = V.getDataAttributes(this._element);
            return (
                Object.keys(t).forEach((e) => {
                    nn.has(e) && delete t[e];
                }),
                ((e = {
                    ...this.constructor.Default,
                    ...t,
                    ...("object" == typeof e && e ? e : {}),
                }).container =
                    !1 === e.container ? document.body : r(e.container)),
                "number" == typeof e.delay &&
                    (e.delay = { show: e.delay, hide: e.delay }),
                "number" == typeof e.title && (e.title = e.title.toString()),
                "number" == typeof e.content &&
                    (e.content = e.content.toString()),
                o(tn, e, this.constructor.DefaultType),
                e.sanitize &&
                    (e.template = en(e.template, e.allowList, e.sanitizeFn)),
                e
            );
        }
        _getDelegateConfig() {
            const e = {};
            for (const t in this._config)
                this.constructor.Default[t] !== this._config[t] &&
                    (e[t] = this._config[t]);
            return e;
        }
        _cleanTipClass() {
            const e = this.getTipElement(),
                t = new RegExp(
                    `(^|\\s)${this._getBasicClassPrefix()}\\S+`,
                    "g"
                ),
                i = e.getAttribute("class").match(t);
            null !== i &&
                i.length > 0 &&
                i.map((e) => e.trim()).forEach((t) => e.classList.remove(t));
        }
        _getBasicClassPrefix() {
            return "bs-tooltip";
        }
        _handlePopperPlacementChange(e) {
            const { state: t } = e;
            t &&
                ((this.tip = t.elements.popper),
                this._cleanTipClass(),
                this._addAttachmentClass(this._getAttachment(t.placement)));
        }
        _disposePopper() {
            this._popper && (this._popper.destroy(), (this._popper = null));
        }
        static jQueryInterface(e) {
            return this.each(function () {
                const t = vn.getOrCreateInstance(this, e);
                if ("string" == typeof e) {
                    if (void 0 === t[e])
                        throw new TypeError(`No method named "${e}"`);
                    t[e]();
                }
            });
        }
    }
    g(vn);
    const yn = {
            ...vn.Default,
            placement: "right",
            offset: [0, 8],
            trigger: "click",
            content: "",
            template:
                '<div class="popover" role="tooltip"><div class="popover-arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
        },
        bn = { ...vn.DefaultType, content: "(string|element|function)" },
        _n = {
            HIDE: "hide.bs.popover",
            HIDDEN: "hidden.bs.popover",
            SHOW: "show.bs.popover",
            SHOWN: "shown.bs.popover",
            INSERTED: "inserted.bs.popover",
            CLICK: "click.bs.popover",
            FOCUSIN: "focusin.bs.popover",
            FOCUSOUT: "focusout.bs.popover",
            MOUSEENTER: "mouseenter.bs.popover",
            MOUSELEAVE: "mouseleave.bs.popover",
        };
    class xn extends vn {
        static get Default() {
            return yn;
        }
        static get NAME() {
            return "popover";
        }
        static get Event() {
            return _n;
        }
        static get DefaultType() {
            return bn;
        }
        isWithContent() {
            return this.getTitle() || this._getContent();
        }
        setContent(e) {
            this._sanitizeAndSetContent(e, this.getTitle(), ".popover-header"),
                this._sanitizeAndSetContent(
                    e,
                    this._getContent(),
                    ".popover-body"
                );
        }
        _getContent() {
            return this._resolvePossibleFunction(this._config.content);
        }
        _getBasicClassPrefix() {
            return "bs-popover";
        }
        static jQueryInterface(e) {
            return this.each(function () {
                const t = xn.getOrCreateInstance(this, e);
                if ("string" == typeof e) {
                    if (void 0 === t[e])
                        throw new TypeError(`No method named "${e}"`);
                    t[e]();
                }
            });
        }
    }
    g(xn);
    const wn = "scrollspy",
        Sn = ".bs.scrollspy",
        Mn = { offset: 10, method: "auto", target: "" },
        En = {
            offset: "number",
            method: "string",
            target: "(string|element)",
        },
        kn = "dropdown-item",
        Tn = "active",
        Cn = ".nav-link",
        An = ".nav-link, .list-group-item, .dropdown-item",
        Pn = "position";
    class Ln extends $ {
        constructor(e, t) {
            super(e),
                (this._scrollElement =
                    "BODY" === this._element.tagName ? window : this._element),
                (this._config = this._getConfig(t)),
                (this._offsets = []),
                (this._targets = []),
                (this._activeTarget = null),
                (this._scrollHeight = 0),
                I.on(this._scrollElement, "scroll.bs.scrollspy", () =>
                    this._process()
                ),
                this.refresh(),
                this._process();
        }
        static get Default() {
            return Mn;
        }
        static get NAME() {
            return wn;
        }
        refresh() {
            const e =
                    this._scrollElement === this._scrollElement.window
                        ? "offset"
                        : Pn,
                t = "auto" === this._config.method ? e : this._config.method,
                n = t === Pn ? this._getScrollTop() : 0;
            (this._offsets = []),
                (this._targets = []),
                (this._scrollHeight = this._getScrollHeight());
            q.find(An, this._config.target)
                .map((e) => {
                    const s = i(e),
                        a = s ? q.findOne(s) : null;
                    if (a) {
                        const e = a.getBoundingClientRect();
                        if (e.width || e.height) return [V[t](a).top + n, s];
                    }
                    return null;
                })
                .filter((e) => e)
                .sort((e, t) => e[0] - t[0])
                .forEach((e) => {
                    this._offsets.push(e[0]), this._targets.push(e[1]);
                });
        }
        dispose() {
            I.off(this._scrollElement, Sn), super.dispose();
        }
        _getConfig(e) {
            return (
                ((e = {
                    ...Mn,
                    ...V.getDataAttributes(this._element),
                    ...("object" == typeof e && e ? e : {}),
                }).target = r(e.target) || document.documentElement),
                o(wn, e, En),
                e
            );
        }
        _getScrollTop() {
            return this._scrollElement === window
                ? this._scrollElement.pageYOffset
                : this._scrollElement.scrollTop;
        }
        _getScrollHeight() {
            return (
                this._scrollElement.scrollHeight ||
                Math.max(
                    document.body.scrollHeight,
                    document.documentElement.scrollHeight
                )
            );
        }
        _getOffsetHeight() {
            return this._scrollElement === window
                ? window.innerHeight
                : this._scrollElement.getBoundingClientRect().height;
        }
        _process() {
            const e = this._getScrollTop() + this._config.offset,
                t = this._getScrollHeight(),
                i = this._config.offset + t - this._getOffsetHeight();
            if ((this._scrollHeight !== t && this.refresh(), e >= i)) {
                const e = this._targets[this._targets.length - 1];
                this._activeTarget !== e && this._activate(e);
            } else {
                if (
                    this._activeTarget &&
                    e < this._offsets[0] &&
                    this._offsets[0] > 0
                )
                    return (this._activeTarget = null), void this._clear();
                for (let t = this._offsets.length; t--; ) {
                    this._activeTarget !== this._targets[t] &&
                        e >= this._offsets[t] &&
                        (void 0 === this._offsets[t + 1] ||
                            e < this._offsets[t + 1]) &&
                        this._activate(this._targets[t]);
                }
            }
        }
        _activate(e) {
            (this._activeTarget = e), this._clear();
            const t = An.split(",").map(
                    (t) => `${t}[data-bs-target="${e}"],${t}[href="${e}"]`
                ),
                i = q.findOne(t.join(","), this._config.target);
            i.classList.add(Tn),
                i.classList.contains(kn)
                    ? q
                          .findOne(".dropdown-toggle", i.closest(".dropdown"))
                          .classList.add(Tn)
                    : q.parents(i, ".nav, .list-group").forEach((e) => {
                          q
                              .prev(e, ".nav-link, .list-group-item")
                              .forEach((e) => e.classList.add(Tn)),
                              q.prev(e, ".nav-item").forEach((e) => {
                                  q.children(e, Cn).forEach((e) =>
                                      e.classList.add(Tn)
                                  );
                              });
                      }),
                I.trigger(this._scrollElement, "activate.bs.scrollspy", {
                    relatedTarget: e,
                });
        }
        _clear() {
            q.find(An, this._config.target)
                .filter((e) => e.classList.contains(Tn))
                .forEach((e) => e.classList.remove(Tn));
        }
        static jQueryInterface(e) {
            return this.each(function () {
                const t = Ln.getOrCreateInstance(this, e);
                if ("string" == typeof e) {
                    if (void 0 === t[e])
                        throw new TypeError(`No method named "${e}"`);
                    t[e]();
                }
            });
        }
    }
    I.on(window, "load.bs.scrollspy.data-api", () => {
        q.find('[data-bs-spy="scroll"]').forEach((e) => new Ln(e));
    }),
        g(Ln);
    const Dn = "active",
        On = "fade",
        Nn = "show",
        In = ".active",
        Rn = ":scope > li > .active";
    class zn extends $ {
        static get NAME() {
            return "tab";
        }
        show() {
            if (
                this._element.parentNode &&
                this._element.parentNode.nodeType === Node.ELEMENT_NODE &&
                this._element.classList.contains(Dn)
            )
                return;
            let e;
            const t = n(this._element),
                i = this._element.closest(".nav, .list-group");
            if (i) {
                const t = "UL" === i.nodeName || "OL" === i.nodeName ? Rn : In;
                (e = q.find(t, i)), (e = e[e.length - 1]);
            }
            const s = e
                ? I.trigger(e, "hide.bs.tab", {
                      relatedTarget: this._element,
                  })
                : null;
            if (
                I.trigger(this._element, "show.bs.tab", {
                    relatedTarget: e,
                }).defaultPrevented ||
                (null !== s && s.defaultPrevented)
            )
                return;
            this._activate(this._element, i);
            const a = () => {
                I.trigger(e, "hidden.bs.tab", {
                    relatedTarget: this._element,
                }),
                    I.trigger(this._element, "shown.bs.tab", {
                        relatedTarget: e,
                    });
            };
            t ? this._activate(t, t.parentNode, a) : a();
        }
        _activate(e, t, i) {
            const n = (
                    !t || ("UL" !== t.nodeName && "OL" !== t.nodeName)
                        ? q.children(t, In)
                        : q.find(Rn, t)
                )[0],
                s = i && n && n.classList.contains(On),
                a = () => this._transitionComplete(e, n, i);
            n && s
                ? (n.classList.remove(Nn), this._queueCallback(a, e, !0))
                : a();
        }
        _transitionComplete(e, t, i) {
            if (t) {
                t.classList.remove(Dn);
                const e = q.findOne(
                    ":scope > .dropdown-menu .active",
                    t.parentNode
                );
                e && e.classList.remove(Dn),
                    "tab" === t.getAttribute("role") &&
                        t.setAttribute("aria-selected", !1);
            }
            e.classList.add(Dn),
                "tab" === e.getAttribute("role") &&
                    e.setAttribute("aria-selected", !0),
                h(e),
                e.classList.contains(On) && e.classList.add(Nn);
            let n = e.parentNode;
            if (
                (n && "LI" === n.nodeName && (n = n.parentNode),
                n && n.classList.contains("dropdown-menu"))
            ) {
                const t = e.closest(".dropdown");
                t &&
                    q
                        .find(".dropdown-toggle", t)
                        .forEach((e) => e.classList.add(Dn)),
                    e.setAttribute("aria-expanded", !0);
            }
            i && i();
        }
        static jQueryInterface(e) {
            return this.each(function () {
                const t = zn.getOrCreateInstance(this);
                if ("string" == typeof e) {
                    if (void 0 === t[e])
                        throw new TypeError(`No method named "${e}"`);
                    t[e]();
                }
            });
        }
    }
    I.on(
        document,
        "click.bs.tab.data-api",
        '[data-bs-toggle="tab"], [data-bs-toggle="pill"], [data-bs-toggle="list"]',
        function (e) {
            if (
                (["A", "AREA"].includes(this.tagName) && e.preventDefault(),
                u(this))
            )
                return;
            zn.getOrCreateInstance(this).show();
        }
    ),
        g(zn);
    const $n = "toast",
        Fn = "hide",
        Hn = "show",
        jn = "showing",
        Wn = { animation: "boolean", autohide: "boolean", delay: "number" },
        Yn = { animation: !0, autohide: !0, delay: 5e3 };
    class Bn extends $ {
        constructor(e, t) {
            super(e),
                (this._config = this._getConfig(t)),
                (this._timeout = null),
                (this._hasMouseInteraction = !1),
                (this._hasKeyboardInteraction = !1),
                this._setListeners();
        }
        static get DefaultType() {
            return Wn;
        }
        static get Default() {
            return Yn;
        }
        static get NAME() {
            return $n;
        }
        show() {
            if (I.trigger(this._element, "show.bs.toast").defaultPrevented)
                return;
            this._clearTimeout(),
                this._config.animation && this._element.classList.add("fade");
            this._element.classList.remove(Fn),
                h(this._element),
                this._element.classList.add(Hn),
                this._element.classList.add(jn),
                this._queueCallback(
                    () => {
                        this._element.classList.remove(jn),
                            I.trigger(this._element, "shown.bs.toast"),
                            this._maybeScheduleHide();
                    },
                    this._element,
                    this._config.animation
                );
        }
        hide() {
            if (!this._element.classList.contains(Hn)) return;
            if (I.trigger(this._element, "hide.bs.toast").defaultPrevented)
                return;
            this._element.classList.add(jn),
                this._queueCallback(
                    () => {
                        this._element.classList.add(Fn),
                            this._element.classList.remove(jn),
                            this._element.classList.remove(Hn),
                            I.trigger(this._element, "hidden.bs.toast");
                    },
                    this._element,
                    this._config.animation
                );
        }
        dispose() {
            this._clearTimeout(),
                this._element.classList.contains(Hn) &&
                    this._element.classList.remove(Hn),
                super.dispose();
        }
        _getConfig(e) {
            return (
                (e = {
                    ...Yn,
                    ...V.getDataAttributes(this._element),
                    ...("object" == typeof e && e ? e : {}),
                }),
                o($n, e, this.constructor.DefaultType),
                e
            );
        }
        _maybeScheduleHide() {
            this._config.autohide &&
                (this._hasMouseInteraction ||
                    this._hasKeyboardInteraction ||
                    (this._timeout = setTimeout(() => {
                        this.hide();
                    }, this._config.delay)));
        }
        _onInteraction(e, t) {
            switch (e.type) {
                case "mouseover":
                case "mouseout":
                    this._hasMouseInteraction = t;
                    break;
                case "focusin":
                case "focusout":
                    this._hasKeyboardInteraction = t;
            }
            if (t) return void this._clearTimeout();
            const i = e.relatedTarget;
            this._element === i ||
                this._element.contains(i) ||
                this._maybeScheduleHide();
        }
        _setListeners() {
            I.on(this._element, "mouseover.bs.toast", (e) =>
                this._onInteraction(e, !0)
            ),
                I.on(this._element, "mouseout.bs.toast", (e) =>
                    this._onInteraction(e, !1)
                ),
                I.on(this._element, "focusin.bs.toast", (e) =>
                    this._onInteraction(e, !0)
                ),
                I.on(this._element, "focusout.bs.toast", (e) =>
                    this._onInteraction(e, !1)
                );
        }
        _clearTimeout() {
            clearTimeout(this._timeout), (this._timeout = null);
        }
        static jQueryInterface(e) {
            return this.each(function () {
                const t = Bn.getOrCreateInstance(this, e);
                if ("string" == typeof e) {
                    if (void 0 === t[e])
                        throw new TypeError(`No method named "${e}"`);
                    t[e](this);
                }
            });
        }
    }
    F(Bn), g(Bn);
    return {
        Alert: H,
        Button: W,
        Carousel: se,
        Collapse: me,
        Dropdown: hi,
        Modal: ji,
        Offcanvas: Xi,
        Popover: xn,
        ScrollSpy: Ln,
        Tab: zn,
        Toast: Bn,
        Tooltip: vn,
    };
}),
    (function (e, t) {
        "object" == typeof exports && "object" == typeof module
            ? (module.exports = t())
            : "function" == typeof define && define.amd
            ? define("Amplitude", [], t)
            : "object" == typeof exports
            ? (exports.Amplitude = t())
            : (e.Amplitude = t());
    })(this, function () {
        return (function (e) {
            var t = {};
            function i(n) {
                if (t[n]) return t[n].exports;
                var s = (t[n] = { i: n, l: !1, exports: {} });
                return (
                    e[n].call(s.exports, s, s.exports, i), (s.l = !0), s.exports
                );
            }
            return (
                (i.m = e),
                (i.c = t),
                (i.i = function (e) {
                    return e;
                }),
                (i.d = function (e, t, n) {
                    i.o(e, t) ||
                        Object.defineProperty(e, t, {
                            configurable: !1,
                            enumerable: !0,
                            get: n,
                        });
                }),
                (i.n = function (e) {
                    var t =
                        e && e.__esModule
                            ? function () {
                                  return e.default;
                              }
                            : function () {
                                  return e;
                              };
                    return i.d(t, "a", t), t;
                }),
                (i.o = function (e, t) {
                    return Object.prototype.hasOwnProperty.call(e, t);
                }),
                (i.p = ""),
                i((i.s = 47))
            );
        })([
            function (e, t, i) {
                "use strict";
                var n = i(59);
                e.exports = {
                    version: n.version,
                    audio: new Audio(),
                    active_metadata: {},
                    active_album: "",
                    active_index: 0,
                    active_playlist: null,
                    playback_speed: 1,
                    callbacks: {},
                    songs: [],
                    playlists: {},
                    start_song: "",
                    starting_playlist: "",
                    starting_playlist_song: "",
                    repeat: !1,
                    repeat_song: !1,
                    shuffle_list: {},
                    shuffle_on: !1,
                    default_album_art: "",
                    default_playlist_art: "",
                    debug: !1,
                    volume: 0.5,
                    pre_mute_volume: 0.5,
                    volume_increment: 5,
                    volume_decrement: 5,
                    soundcloud_client: "",
                    soundcloud_use_art: !1,
                    soundcloud_song_count: 0,
                    soundcloud_songs_ready: 0,
                    is_touch_moving: !1,
                    buffered: 0,
                    bindings: {},
                    continue_next: !0,
                    delay: 0,
                    player_state: "stopped",
                    web_audio_api_available: !1,
                    context: null,
                    source: null,
                    analyser: null,
                    visualizations: { available: [], active: [], backup: "" },
                    waveforms: { sample_rate: 100, built: [] },
                };
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = l(i(0)),
                    s = (l(i(5)), l(i(3)), l(i(2)), l(i(7)), l(i(9))),
                    a = l(i(4)),
                    r = l(i(16)),
                    o = l(i(6));
                function l(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var u = (function () {
                    function e() {
                        (n.default.audio.src = ""), n.default.audio.load();
                    }
                    function t() {
                        (n.default.audio.src = n.default.active_metadata.url),
                            n.default.audio.load();
                    }
                    return {
                        play: function () {
                            r.default.stop(),
                                r.default.run(),
                                n.default.active_metadata.live && t(),
                                /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                                    navigator.userAgent
                                ) &&
                                    !n.default.paused &&
                                    t();
                            var e = n.default.audio.play();
                            void 0 !== e &&
                                e.then(function (e) {}).catch(function (e) {}),
                                n.default.audio.play(),
                                (n.default.audio.playbackRate =
                                    n.default.playback_speed),
                                o.default.setPlayerState();
                        },
                        pause: function () {
                            r.default.stop(),
                                n.default.audio.pause(),
                                (n.default.paused = !0),
                                n.default.active_metadata.live && e(),
                                o.default.setPlayerState();
                        },
                        stop: function () {
                            r.default.stop(),
                                0 != n.default.audio.currentTime &&
                                    (n.default.audio.currentTime = 0),
                                n.default.audio.pause(),
                                n.default.active_metadata.live && e(),
                                o.default.setPlayerState(),
                                s.default.run("stop");
                        },
                        setVolume: function (e) {
                            (n.default.audio.muted = 0 == e),
                                (n.default.volume = e),
                                (n.default.audio.volume = e / 100);
                        },
                        setSongLocation: function (e) {
                            n.default.active_metadata.live ||
                                (n.default.audio.currentTime =
                                    n.default.audio.duration * (e / 100));
                        },
                        skipToLocation: function (e) {
                            n.default.audio.addEventListener(
                                "canplaythrough",
                                function () {
                                    n.default.audio.duration >= e && e > 0
                                        ? (n.default.audio.currentTime = e)
                                        : a.default.writeMessage(
                                              "Amplitude can't skip to a location greater than the duration of the audio or less than 0"
                                          );
                                },
                                { once: !0 }
                            );
                        },
                        disconnectStream: e,
                        reconnectStream: t,
                        setPlaybackSpeed: function (e) {
                            (n.default.playback_speed = e),
                                (n.default.audio.playbackRate =
                                    n.default.playback_speed);
                        },
                    };
                })();
                (t.default = u), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = (function () {
                    function e() {
                        for (
                            var e = a.default.audio.paused
                                    ? "paused"
                                    : "playing",
                                t = document.querySelectorAll(
                                    ".amplitude-play-pause"
                                ),
                                i = 0;
                            i < t.length;
                            i++
                        ) {
                            var n = t[i].getAttribute(
                                    "data-amplitude-playlist"
                                ),
                                o = t[i].getAttribute(
                                    "data-amplitude-song-index"
                                );
                            if (null == n && null == o)
                                switch (e) {
                                    case "playing":
                                        s(t[i]);
                                        break;
                                    case "paused":
                                        r(t[i]);
                                }
                        }
                    }
                    function t() {
                        for (
                            var e = a.default.audio.paused
                                    ? "paused"
                                    : "playing",
                                t = document.querySelectorAll(
                                    '.amplitude-play-pause[data-amplitude-playlist="' +
                                        a.default.active_playlist +
                                        '"]'
                                ),
                                i = 0;
                            i < t.length;
                            i++
                        ) {
                            if (
                                null ==
                                t[i].getAttribute("data-amplitude-song-index")
                            )
                                switch (e) {
                                    case "playing":
                                        s(t[i]);
                                        break;
                                    case "paused":
                                        r(t[i]);
                                }
                        }
                    }
                    function i() {
                        for (
                            var e = a.default.audio.paused
                                    ? "paused"
                                    : "playing",
                                t = document.querySelectorAll(
                                    '.amplitude-play-pause[data-amplitude-song-index="' +
                                        a.default.active_index +
                                        '"]'
                                ),
                                i = 0;
                            i < t.length;
                            i++
                        ) {
                            if (
                                null ==
                                t[i].getAttribute("data-amplitude-playlist")
                            )
                                switch (e) {
                                    case "playing":
                                        s(t[i]);
                                        break;
                                    case "paused":
                                        r(t[i]);
                                }
                        }
                    }
                    function n() {
                        for (
                            var e = a.default.audio.paused
                                    ? "paused"
                                    : "playing",
                                t =
                                    "" != a.default.active_playlist &&
                                    null != a.default.active_playlist
                                        ? a.default.playlists[
                                              a.default.active_playlist
                                          ].active_index
                                        : null,
                                i = document.querySelectorAll(
                                    '.amplitude-play-pause[data-amplitude-song-index="' +
                                        t +
                                        '"][data-amplitude-playlist="' +
                                        a.default.active_playlist +
                                        '"]'
                                ),
                                n = 0;
                            n < i.length;
                            n++
                        )
                            switch (e) {
                                case "playing":
                                    s(i[n]);
                                    break;
                                case "paused":
                                    r(i[n]);
                            }
                    }
                    function s(e) {
                        e.classList.add("amplitude-playing"),
                            e.classList.remove("amplitude-paused");
                    }
                    function r(e) {
                        e.classList.remove("amplitude-playing"),
                            e.classList.add("amplitude-paused");
                    }
                    return {
                        sync: function () {
                            e(), t(), i(), n();
                        },
                        syncGlobal: e,
                        syncPlaylist: t,
                        syncSong: i,
                        syncSongInPlaylist: n,
                        syncToPause: function () {
                            for (
                                var e = document.querySelectorAll(
                                        ".amplitude-play-pause"
                                    ),
                                    t = 0;
                                t < e.length;
                                t++
                            )
                                r(e[t]);
                        },
                    };
                })();
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = f(i(0)),
                    s = f(i(1)),
                    a = f(i(9)),
                    r = f(i(5)),
                    o = f(i(2)),
                    l = f(i(14)),
                    u = f(i(20)),
                    d = f(i(15)),
                    c = f(i(7)),
                    h = f(i(49));
                function f(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var p = (function () {
                    function e(e, t) {
                        var s =
                            arguments.length > 2 &&
                            void 0 !== arguments[2] &&
                            arguments[2];
                        i(e),
                            (n.default.audio.src = e.url),
                            (n.default.active_metadata = e),
                            (n.default.active_album = e.album),
                            (n.default.active_index = parseInt(t)),
                            f(s);
                    }
                    function t(e, t, s) {
                        var a =
                            arguments.length > 3 &&
                            void 0 !== arguments[3] &&
                            arguments[3];
                        i(t),
                            (n.default.audio.src = t.url),
                            (n.default.active_metadata = t),
                            (n.default.active_album = t.album),
                            (n.default.active_index = null),
                            (n.default.playlists[e].active_index = parseInt(s)),
                            f(a);
                    }
                    function i(e) {
                        s.default.stop(),
                            o.default.syncToPause(),
                            l.default.resetElements(),
                            u.default.resetElements(),
                            d.default.resetCurrentTimes(),
                            r.default.newAlbum(e) &&
                                a.default.run("album_change");
                    }
                    function f(e) {
                        c.default.displayMetaData(),
                            h.default.setActive(e),
                            d.default.resetDurationTimes(),
                            a.default.run("song_change");
                    }
                    function p(e) {
                        n.default.active_playlist != e &&
                            (a.default.run("playlist_changed"),
                            (n.default.active_playlist = e),
                            null != e &&
                                (n.default.playlists[e].active_index = 0));
                    }
                    return {
                        setNext: function () {
                            var t =
                                    arguments.length > 0 &&
                                    void 0 !== arguments[0] &&
                                    arguments[0],
                                i = null,
                                r = {},
                                l = !1;
                            n.default.repeat_song
                                ? n.default.shuffle_on
                                    ? ((i =
                                          n.default.shuffle_list[
                                              n.default.active_index
                                          ].index),
                                      (r = n.default.shuffle_list[i]))
                                    : ((i = n.default.active_index),
                                      (r = n.default.songs[i]))
                                : n.default.shuffle_on
                                ? (parseInt(n.default.active_index) + 1 <
                                  n.default.shuffle_list.length
                                      ? (i =
                                            parseInt(n.default.active_index) +
                                            1)
                                      : ((i = 0), (l = !0)),
                                  (r = n.default.shuffle_list[i]))
                                : (parseInt(n.default.active_index) + 1 <
                                  n.default.songs.length
                                      ? (i =
                                            parseInt(n.default.active_index) +
                                            1)
                                      : ((i = 0), (l = !0)),
                                  (r = n.default.songs[i])),
                                e(r, i),
                                (l && !n.default.repeat) ||
                                    (t && !n.default.repeat && l) ||
                                    s.default.play(),
                                o.default.sync(),
                                a.default.run("next"),
                                n.default.repeat_song &&
                                    a.default.run("song_repeated");
                        },
                        setNextPlaylist: function (e) {
                            var i =
                                    arguments.length > 1 &&
                                    void 0 !== arguments[1] &&
                                    arguments[1],
                                r = null,
                                l = {},
                                u = !1;
                            n.default.repeat_song
                                ? n.default.playlists[e].shuffle
                                    ? ((r =
                                          n.default.playlists[e].active_index),
                                      (l =
                                          n.default.playlists[e].shuffle_list[
                                              r
                                          ]))
                                    : ((r =
                                          n.default.playlists[e].active_index),
                                      (l = n.default.playlists[e].songs[r]))
                                : n.default.playlists[e].shuffle
                                ? (parseInt(
                                      n.default.playlists[e].active_index
                                  ) +
                                      1 <
                                  n.default.playlists[e].shuffle_list.length
                                      ? (r =
                                            n.default.playlists[e]
                                                .active_index + 1)
                                      : ((r = 0), (u = !0)),
                                  (l = n.default.playlists[e].shuffle_list[r]))
                                : (parseInt(
                                      n.default.playlists[e].active_index
                                  ) +
                                      1 <
                                  n.default.playlists[e].songs.length
                                      ? (r =
                                            parseInt(
                                                n.default.playlists[e]
                                                    .active_index
                                            ) + 1)
                                      : ((r = 0), (u = !0)),
                                  (l = n.default.playlists[e].songs[r])),
                                p(e),
                                t(e, l, r),
                                (u && !n.default.repeat) ||
                                    (i && !n.default.repeat && u) ||
                                    s.default.play(),
                                o.default.sync(),
                                a.default.run("next"),
                                n.default.repeat_song &&
                                    a.default.run("song_repeated");
                        },
                        setPrevious: function () {
                            var t = null,
                                i = {};
                            n.default.repeat_song
                                ? n.default.shuffle_on
                                    ? ((t = n.default.active_index),
                                      (i = n.default.shuffle_list[t]))
                                    : ((t = n.default.active_index),
                                      (i = n.default.songs[t]))
                                : ((t =
                                      parseInt(n.default.active_index) - 1 >= 0
                                          ? parseInt(n.default.active_index - 1)
                                          : parseInt(
                                                n.default.songs.length - 1
                                            )),
                                  (i = n.default.shuffle_on
                                      ? n.default.shuffle_list[t]
                                      : n.default.songs[t])),
                                e(i, t),
                                s.default.play(),
                                o.default.sync(),
                                a.default.run("prev"),
                                n.default.repeat_song &&
                                    a.default.run("song_repeated");
                        },
                        setPreviousPlaylist: function (e) {
                            var i = null,
                                r = {};
                            n.default.repeat_song
                                ? n.default.playlists[e].shuffle
                                    ? ((i =
                                          n.default.playlists[e].active_index),
                                      (r =
                                          n.default.playlists[e].shuffle_list[
                                              i
                                          ]))
                                    : ((i =
                                          n.default.playlists[e].active_index),
                                      (r = n.default.playlists[e].songs[i]))
                                : ((i =
                                      parseInt(
                                          n.default.playlists[e].active_index
                                      ) -
                                          1 >=
                                      0
                                          ? parseInt(
                                                n.default.playlists[e]
                                                    .active_index - 1
                                            )
                                          : parseInt(
                                                n.default.playlists[e].songs
                                                    .length - 1
                                            )),
                                  (r = n.default.playlists[e].shuffle
                                      ? n.default.playlists[e].shuffle_list[i]
                                      : n.default.playlists[e].songs[i])),
                                p(e),
                                t(e, r, i),
                                s.default.play(),
                                o.default.sync(),
                                a.default.run("prev"),
                                n.default.repeat_song &&
                                    a.default.run("song_repeated");
                        },
                        changeSong: e,
                        changeSongPlaylist: t,
                        setActivePlaylist: p,
                    };
                })();
                (t.default = p), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = {
                    writeMessage: function (e) {
                        a.default.debug && console.log(e);
                    },
                };
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = {
                    newSong: function (e, t) {
                        return (
                            a.default.active_playlist != e ||
                            (null == a.default.active_playlist && null == e
                                ? a.default.active_index != t
                                : a.default.active_playlist == e &&
                                  a.default.playlists[e].active_index != t)
                        );
                    },
                    newAlbum: function (e) {
                        return a.default.active_album != e;
                    },
                    newPlaylist: function (e) {
                        return a.default.active_playlist != e;
                    },
                    isURL: function (e) {
                        return /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/.test(
                            e
                        );
                    },
                    isInt: function (e) {
                        return (
                            !isNaN(e) &&
                            parseInt(Number(e)) == e &&
                            !isNaN(parseInt(e, 10))
                        );
                    },
                };
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = {
                    resetConfig: function () {
                        (a.default.audio = new Audio()),
                            (a.default.active_metadata = {}),
                            (a.default.active_album = ""),
                            (a.default.active_index = 0),
                            (a.default.active_playlist = null),
                            (a.default.playback_speed = 1),
                            (a.default.callbacks = {}),
                            (a.default.songs = []),
                            (a.default.playlists = {}),
                            (a.default.start_song = ""),
                            (a.default.starting_playlist = ""),
                            (a.default.starting_playlist_song = ""),
                            (a.default.repeat = !1),
                            (a.default.shuffle_list = {}),
                            (a.default.shuffle_on = !1),
                            (a.default.default_album_art = ""),
                            (a.default.default_playlist_art = ""),
                            (a.default.debug = !1),
                            (a.default.volume = 0.5),
                            (a.default.pre_mute_volume = 0.5),
                            (a.default.volume_increment = 5),
                            (a.default.volume_decrement = 5),
                            (a.default.soundcloud_client = ""),
                            (a.default.soundcloud_use_art = !1),
                            (a.default.soundcloud_song_count = 0),
                            (a.default.soundcloud_songs_ready = 0),
                            (a.default.continue_next = !0);
                    },
                    setPlayerState: function () {
                        a.default.audio.paused &&
                            0 == a.default.audio.currentTime &&
                            (a.default.player_state = "stopped"),
                            a.default.audio.paused &&
                                a.default.audio.currentTime > 0 &&
                                (a.default.player_state = "paused"),
                            a.default.audio.paused ||
                                (a.default.player_state = "playing");
                    },
                };
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = (function () {
                    function e() {
                        for (
                            var e = ["image_url"],
                                t = document.querySelectorAll(
                                    "[data-amplitude-playlist-info]"
                                ),
                                i = 0;
                            i < t.length;
                            i++
                        ) {
                            var n = t[i].getAttribute(
                                    "data-amplitude-playlist-info"
                                ),
                                s = t[i].getAttribute(
                                    "data-amplitude-playlist"
                                );
                            null != a.default.playlists[s][n]
                                ? e.indexOf(n) >= 0
                                    ? t[i].setAttribute(
                                          "src",
                                          a.default.playlists[s][n]
                                      )
                                    : (t[i].innerHTML =
                                          a.default.playlists[s][n])
                                : e.indexOf(n) >= 0
                                ? "" != a.default.default_playlist_art
                                    ? t[i].setAttribute(
                                          "src",
                                          a.default.default_playlist_art
                                      )
                                    : t[i].setAttribute("src", "")
                                : (t[i].innerHTML = "");
                        }
                    }
                    return {
                        displayMetaData: function () {
                            for (
                                var e = [
                                        "cover_art_url",
                                        "station_art_url",
                                        "podcast_episode_cover_art_url",
                                    ],
                                    t = document.querySelectorAll(
                                        "[data-amplitude-song-info]"
                                    ),
                                    i = 0;
                                i < t.length;
                                i++
                            ) {
                                var n = t[i].getAttribute(
                                        "data-amplitude-song-info"
                                    ),
                                    s = t[i].getAttribute(
                                        "data-amplitude-playlist"
                                    ),
                                    r = t[i].getAttribute(
                                        "data-amplitude-song-index"
                                    );
                                if (
                                    null == r &&
                                    (a.default.active_playlist == s ||
                                        (null == s && null == r))
                                ) {
                                    var o =
                                        null != a.default.active_metadata[n]
                                            ? a.default.active_metadata[n]
                                            : null;
                                    e.indexOf(n) >= 0
                                        ? ((o =
                                              o || a.default.default_album_art),
                                          t[i].setAttribute("src", o))
                                        : ((o = o || ""), (t[i].innerHTML = o));
                                }
                            }
                        },
                        setFirstSongInPlaylist: function (e, t) {
                            for (
                                var i = [
                                        "cover_art_url",
                                        "station_art_url",
                                        "podcast_episode_cover_art_url",
                                    ],
                                    n = document.querySelectorAll(
                                        '[data-amplitude-song-info][data-amplitude-playlist="' +
                                            t +
                                            '"]'
                                    ),
                                    s = 0;
                                s < n.length;
                                s++
                            ) {
                                var a = n[s].getAttribute(
                                    "data-amplitude-song-info"
                                );
                                n[s].getAttribute("data-amplitude-playlist") ==
                                    t &&
                                    (null != e[a]
                                        ? i.indexOf(a) >= 0
                                            ? n[s].setAttribute("src", e[a])
                                            : (n[s].innerHTML = e[a])
                                        : i.indexOf(a) >= 0
                                        ? "" != e.default_album_art
                                            ? n[s].setAttribute(
                                                  "src",
                                                  e.default_album_art
                                              )
                                            : n[s].setAttribute("src", "")
                                        : (n[s].innerHTML = ""));
                            }
                        },
                        syncMetaData: function () {
                            for (
                                var t = [
                                        "cover_art_url",
                                        "station_art_url",
                                        "podcast_episode_cover_art_url",
                                    ],
                                    i = document.querySelectorAll(
                                        "[data-amplitude-song-info]"
                                    ),
                                    n = 0;
                                n < i.length;
                                n++
                            ) {
                                var s = i[n].getAttribute(
                                        "data-amplitude-song-index"
                                    ),
                                    r = i[n].getAttribute(
                                        "data-amplitude-playlist"
                                    );
                                if (null != s && null == r) {
                                    var o = i[n].getAttribute(
                                            "data-amplitude-song-info"
                                        ),
                                        l =
                                            null != a.default.songs[s][o]
                                                ? a.default.songs[s][o]
                                                : null;
                                    t.indexOf(o) >= 0
                                        ? ((l =
                                              l || a.default.default_album_art),
                                          i[n].setAttribute("src", l))
                                        : (i[n].innerHTML = l);
                                }
                                if (null != s && null != r) {
                                    var u = i[n].getAttribute(
                                        "data-amplitude-song-info"
                                    );
                                    null !=
                                        a.default.playlists[r].songs[s][u] &&
                                        (t.indexOf(u) >= 0
                                            ? i[n].setAttribute(
                                                  "src",
                                                  a.default.playlists[r].songs[
                                                      s
                                                  ][u]
                                              )
                                            : (i[n].innerHTML =
                                                  a.default.playlists[r].songs[
                                                      s
                                                  ][u]));
                                }
                            }
                            e();
                        },
                        displayPlaylistMetaData: e,
                    };
                })();
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = {
                    syncRepeat: function () {
                        for (
                            var e =
                                    document.getElementsByClassName(
                                        "amplitude-repeat"
                                    ),
                                t = 0;
                            t < e.length;
                            t++
                        )
                            a.default.repeat
                                ? (e[t].classList.add("amplitude-repeat-on"),
                                  e[t].classList.remove("amplitude-repeat-off"))
                                : (e[t].classList.remove("amplitude-repeat-on"),
                                  e[t].classList.add("amplitude-repeat-off"));
                    },
                    syncRepeatPlaylist: function (e) {
                        for (
                            var t =
                                    document.getElementsByClassName(
                                        "amplitude-repeat"
                                    ),
                                i = 0;
                            i < t.length;
                            i++
                        )
                            t[i].getAttribute("data-amplitude-playlist") == e &&
                                (a.default.playlists[e].repeat
                                    ? (t[i].classList.add(
                                          "amplitude-repeat-on"
                                      ),
                                      t[i].classList.remove(
                                          "amplitude-repeat-off"
                                      ))
                                    : (t[i].classList.add(
                                          "amplitude-repeat-off"
                                      ),
                                      t[i].classList.remove(
                                          "amplitude-repeat-on"
                                      )));
                    },
                    syncRepeatSong: function () {
                        for (
                            var e = document.getElementsByClassName(
                                    "amplitude-repeat-song"
                                ),
                                t = 0;
                            t < e.length;
                            t++
                        )
                            a.default.repeat_song
                                ? (e[t].classList.add(
                                      "amplitude-repeat-song-on"
                                  ),
                                  e[t].classList.remove(
                                      "amplitude-repeat-song-off"
                                  ))
                                : (e[t].classList.remove(
                                      "amplitude-repeat-song-on"
                                  ),
                                  e[t].classList.add(
                                      "amplitude-repeat-song-off"
                                  ));
                    },
                };
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = a(i(0)),
                    s = a(i(4));
                function a(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var r = (function () {
                    function e(e) {
                        if (n.default.callbacks[e]) {
                            var t = n.default.callbacks[e];
                            s.default.writeMessage("Running Callback: " + e);
                            try {
                                t();
                            } catch (e) {
                                if ("CANCEL EVENT" == e.message) throw e;
                                s.default.writeMessage(
                                    "Callback error: " + e.message
                                );
                            }
                        }
                    }
                    return {
                        initialize: function () {
                            n.default.audio.addEventListener(
                                "abort",
                                function () {
                                    e("abort");
                                }
                            ),
                                n.default.audio.addEventListener(
                                    "error",
                                    function () {
                                        e("error");
                                    }
                                ),
                                n.default.audio.addEventListener(
                                    "loadeddata",
                                    function () {
                                        e("loadeddata");
                                    }
                                ),
                                n.default.audio.addEventListener(
                                    "loadedmetadata",
                                    function () {
                                        e("loadedmetadata");
                                    }
                                ),
                                n.default.audio.addEventListener(
                                    "loadstart",
                                    function () {
                                        e("loadstart");
                                    }
                                ),
                                n.default.audio.addEventListener(
                                    "pause",
                                    function () {
                                        e("pause");
                                    }
                                ),
                                n.default.audio.addEventListener(
                                    "playing",
                                    function () {
                                        e("playing");
                                    }
                                ),
                                n.default.audio.addEventListener(
                                    "play",
                                    function () {
                                        e("play");
                                    }
                                ),
                                n.default.audio.addEventListener(
                                    "progress",
                                    function () {
                                        e("progress");
                                    }
                                ),
                                n.default.audio.addEventListener(
                                    "ratechange",
                                    function () {
                                        e("ratechange");
                                    }
                                ),
                                n.default.audio.addEventListener(
                                    "seeked",
                                    function () {
                                        e("seeked");
                                    }
                                ),
                                n.default.audio.addEventListener(
                                    "seeking",
                                    function () {
                                        e("seeking");
                                    }
                                ),
                                n.default.audio.addEventListener(
                                    "stalled",
                                    function () {
                                        e("stalled");
                                    }
                                ),
                                n.default.audio.addEventListener(
                                    "suspend",
                                    function () {
                                        e("suspend");
                                    }
                                ),
                                n.default.audio.addEventListener(
                                    "timeupdate",
                                    function () {
                                        e("timeupdate");
                                    }
                                ),
                                n.default.audio.addEventListener(
                                    "volumechange",
                                    function () {
                                        e("volumechange");
                                    }
                                ),
                                n.default.audio.addEventListener(
                                    "waiting",
                                    function () {
                                        e("waiting");
                                    }
                                ),
                                n.default.audio.addEventListener(
                                    "canplay",
                                    function () {
                                        e("canplay");
                                    }
                                ),
                                n.default.audio.addEventListener(
                                    "canplaythrough",
                                    function () {
                                        e("canplaythrough");
                                    }
                                ),
                                n.default.audio.addEventListener(
                                    "durationchange",
                                    function () {
                                        e("durationchange");
                                    }
                                ),
                                n.default.audio.addEventListener(
                                    "ended",
                                    function () {
                                        e("ended");
                                    }
                                );
                        },
                        run: e,
                    };
                })();
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = {
                    setMuted: function (e) {
                        for (
                            var t =
                                    document.getElementsByClassName(
                                        "amplitude-mute"
                                    ),
                                i = 0;
                            i < t.length;
                            i++
                        )
                            e
                                ? (t[i].classList.remove("amplitude-not-muted"),
                                  t[i].classList.add("amplitude-muted"))
                                : (t[i].classList.add("amplitude-not-muted"),
                                  t[i].classList.remove("amplitude-muted"));
                    },
                };
                (t.default = n), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = {
                    sync: function () {
                        for (
                            var e = document.getElementsByClassName(
                                    "amplitude-volume-slider"
                                ),
                                t = 0;
                            t < e.length;
                            t++
                        )
                            e[t].value = 100 * a.default.audio.volume;
                    },
                };
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = {
                    setRepeat: function (e) {
                        a.default.repeat = e;
                    },
                    setRepeatPlaylist: function (e, t) {
                        a.default.playlists[t].repeat = e;
                    },
                    setRepeatSong: function (e) {
                        a.default.repeat_song = e;
                    },
                };
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = (function () {
                    function e() {
                        for (
                            var e = new Array(a.default.songs.length), t = 0;
                            t < a.default.songs.length;
                            t++
                        )
                            e[t] = a.default.songs[t];
                        for (var n = a.default.songs.length - 1; n > 0; n--) {
                            i(
                                e,
                                n,
                                Math.floor(
                                    Math.random() * a.default.songs.length + 1
                                ) - 1
                            );
                        }
                        a.default.shuffle_list = e;
                    }
                    function t(e) {
                        for (
                            var t = new Array(
                                    a.default.playlists[e].songs.length
                                ),
                                n = 0;
                            n < a.default.playlists[e].songs.length;
                            n++
                        )
                            t[n] = a.default.playlists[e].songs[n];
                        for (
                            var s = a.default.playlists[e].songs.length - 1;
                            s > 0;
                            s--
                        ) {
                            i(
                                t,
                                s,
                                Math.floor(
                                    Math.random() *
                                        a.default.playlists[e].songs.length +
                                        1
                                ) - 1
                            );
                        }
                        a.default.playlists[e].shuffle_list = t;
                    }
                    function i(e, t, i) {
                        var n = e[t];
                        (e[t] = e[i]), (e[i] = n);
                    }
                    return {
                        setShuffle: function (t) {
                            (a.default.shuffle_on = t),
                                t ? e() : (a.default.shuffle_list = []);
                        },
                        toggleShuffle: function () {
                            a.default.shuffle_on
                                ? ((a.default.shuffle_on = !1),
                                  (a.default.shuffle_list = []))
                                : ((a.default.shuffle_on = !0), e());
                        },
                        setShufflePlaylist: function (e, i) {
                            (a.default.playlists[e].shuffle = i),
                                a.default.playlists[e].shuffle
                                    ? t(e)
                                    : (a.default.playlists[e].shuffle_list =
                                          []);
                        },
                        toggleShufflePlaylist: function (e) {
                            a.default.playlists[e].shuffle
                                ? ((a.default.playlists[e].shuffle = !1),
                                  (a.default.playlists[e].shuffle_list = []))
                                : ((a.default.playlists[e].shuffle = !0), t(e));
                        },
                        shuffleSongs: e,
                        shufflePlaylistSongs: t,
                    };
                })();
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = (function () {
                    function e(e) {
                        e = isNaN(e) ? 0 : e;
                        for (
                            var t = document.querySelectorAll(
                                    ".amplitude-song-slider"
                                ),
                                i = 0;
                            i < t.length;
                            i++
                        ) {
                            var n = t[i].getAttribute(
                                    "data-amplitude-playlist"
                                ),
                                s = t[i].getAttribute(
                                    "data-amplitude-song-index"
                                );
                            null == n && null == s && (t[i].value = e);
                        }
                    }
                    function t(e, t) {
                        e = isNaN(e) ? 0 : e;
                        for (
                            var i = document.querySelectorAll(
                                    '.amplitude-song-slider[data-amplitude-playlist="' +
                                        t +
                                        '"]'
                                ),
                                n = 0;
                            n < i.length;
                            n++
                        ) {
                            var s = i[n].getAttribute(
                                    "data-amplitude-playlist"
                                ),
                                a = i[n].getAttribute(
                                    "data-amplitude-song-index"
                                );
                            s == t && null == a && (i[n].value = e);
                        }
                    }
                    function i(e, t) {
                        if (null == a.default.active_playlist) {
                            e = isNaN(e) ? 0 : e;
                            for (
                                var i = document.querySelectorAll(
                                        '.amplitude-song-slider[data-amplitude-song-index="' +
                                            t +
                                            '"]'
                                    ),
                                    n = 0;
                                n < i.length;
                                n++
                            ) {
                                var s = i[n].getAttribute(
                                        "data-amplitude-playlist"
                                    ),
                                    r = i[n].getAttribute(
                                        "data-amplitude-song-index"
                                    );
                                null == s && r == t && (i[n].value = e);
                            }
                        }
                    }
                    function n(e, t) {
                        e = isNaN(e) ? 0 : e;
                        for (
                            var i =
                                    "" != a.default.active_playlist &&
                                    null != a.default.active_playlist
                                        ? a.default.playlists[
                                              a.default.active_playlist
                                          ].active_index
                                        : null,
                                n = document.querySelectorAll(
                                    '.amplitude-song-slider[data-amplitude-playlist="' +
                                        t +
                                        '"][data-amplitude-song-index="' +
                                        i +
                                        '"]'
                                ),
                                s = 0;
                            s < n.length;
                            s++
                        )
                            n[s].value = e;
                    }
                    return {
                        sync: function (s, a, r) {
                            e(s), t(s, a), i(s, r), n(s, a);
                        },
                        syncMain: e,
                        syncPlaylist: t,
                        syncSong: i,
                        syncSongInPlaylist: n,
                        resetElements: function () {
                            for (
                                var e = document.getElementsByClassName(
                                        "amplitude-song-slider"
                                    ),
                                    t = 0;
                                t < e.length;
                                t++
                            )
                                e[t].value = 0;
                        },
                    };
                })();
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = h(i(53)),
                    s = h(i(50)),
                    a = h(i(51)),
                    r = h(i(52)),
                    o = h(i(54)),
                    l = h(i(55)),
                    u = h(i(56)),
                    d = h(i(57)),
                    c = h(i(58));
                function h(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var f = {
                    resetCurrentTimes: function () {
                        n.default.resetTimes(),
                            s.default.resetTimes(),
                            a.default.resetTimes(),
                            r.default.resetTimes();
                    },
                    syncCurrentTimes: function (e) {
                        n.default.sync(e),
                            s.default.sync(e.hours),
                            a.default.sync(e.minutes),
                            r.default.sync(e.seconds);
                    },
                    resetDurationTimes: function () {
                        o.default.resetTimes(),
                            l.default.resetTimes(),
                            u.default.resetTimes(),
                            d.default.resetTimes(),
                            c.default.resetTimes();
                    },
                    syncDurationTimes: function (e, t) {
                        o.default.sync(e, t),
                            c.default.sync(t),
                            l.default.sync(t.hours),
                            u.default.sync(t.minutes),
                            d.default.sync(t.seconds);
                    },
                };
                (t.default = f), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = s(i(0));
                s(i(4));
                function s(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var a = (function () {
                    function e(e) {
                        var t = n.default.visualization,
                            i =
                                null != n.default.active_index
                                    ? n.default.songs[n.default.active_index]
                                          .visualization
                                    : n.default.playlists[
                                          n.default.active_playlist
                                      ].songs[
                                          n.default.playlists[
                                              n.default.active_playlist
                                          ].active_index
                                      ].visualization;
                        if (
                            null != i &&
                            null != n.default.visualizations.available[i]
                        )
                            a(i, e);
                        else if (
                            null != t &&
                            null != n.default.visualizations.available[t]
                        )
                            a(t, e);
                        else {
                            var s =
                                Object.keys(n.default.visualizations.available)
                                    .length > 0
                                    ? Object.keys(
                                          n.default.visualizations.available
                                      )[0]
                                    : null;
                            null != s && a(s, e);
                        }
                    }
                    function t(e, t) {
                        if (t == n.default.active_playlist) {
                            var i =
                                    n.default.playlists[
                                        n.default.active_playlist
                                    ].songs[
                                        n.default.playlists[
                                            n.default.active_playlist
                                        ].active_index
                                    ].visualization,
                                s =
                                    n.default.playlists[
                                        n.default.active_playlist
                                    ].visualization,
                                r = n.default.visualization;
                            if (
                                null != i &&
                                null != n.default.visualizations.available[i]
                            )
                                a(i, e);
                            else if (
                                null != s &&
                                null != n.default.visualizations.available[s]
                            )
                                a(s, e);
                            else if (
                                null != r &&
                                null != n.default.visualizations.available[r]
                            )
                                a(r, e);
                            else {
                                var o =
                                    Object.keys(
                                        n.default.visualizations.available
                                    ).length > 0
                                        ? Object.keys(
                                              n.default.visualizations.available
                                          )[0]
                                        : null;
                                null != o && a(o, e);
                            }
                        }
                    }
                    function i(e, t) {
                        if (t == n.default.active_index) {
                            var i =
                                    n.default.songs[n.default.active_index]
                                        .visualization,
                                s = n.default.visualization;
                            if (
                                null != i &&
                                null != n.default.visualizations.available[i]
                            )
                                a(i, e);
                            else if (
                                null != s &&
                                null != n.default.visualizations.available[s]
                            )
                                a(s, e);
                            else {
                                var r =
                                    Object.keys(
                                        n.default.visualizations.available
                                    ).length > 0
                                        ? Object.keys(
                                              n.default.visualizations.available
                                          )[0]
                                        : null;
                                null != r && a(r, e);
                            }
                        }
                    }
                    function s(e, t, i) {
                        if (
                            t == n.default.active_playlist &&
                            n.default.playlists[t].active_index == i
                        ) {
                            var s =
                                    n.default.playlists[
                                        n.default.active_playlist
                                    ].songs[
                                        n.default.playlists[
                                            n.default.active_playlist
                                        ].active_index
                                    ].visualization,
                                r =
                                    n.default.playlists[
                                        n.default.active_playlist
                                    ].visualization,
                                o = n.default.visualization;
                            if (
                                null != s &&
                                null != n.default.visualizations.available[s]
                            )
                                a(s, e);
                            else if (
                                null != r &&
                                null != n.default.visualizations.available[r]
                            )
                                a(r, e);
                            else if (
                                null != o &&
                                null != n.default.visualizations.available[o]
                            )
                                a(o, e);
                            else {
                                var l =
                                    Object.keys(
                                        n.default.visualizations.available
                                    ).length > 0
                                        ? Object.keys(
                                              n.default.visualizations.available
                                          )[0]
                                        : null;
                                null != l && a(l, e);
                            }
                        }
                    }
                    function a(e, t) {
                        var i = new n.default.visualizations.available[
                            e
                        ].object();
                        i.setPreferences(
                            n.default.visualizations.available[e].preferences
                        ),
                            i.startVisualization(t),
                            n.default.visualizations.active.push(i);
                    }
                    function r(e) {
                        e.style.backgroundImage =
                            "url(" +
                            n.default.active_metadata.cover_art_url +
                            ")";
                    }
                    function o(e, t) {
                        n.default.active_playlist == t &&
                            (e.style.backgroundImage =
                                "url(" +
                                n.default.active_metadata.cover_art_url +
                                ")");
                    }
                    function l(e, t) {
                        n.default.active_index == t &&
                            (e.style.backgroundImage =
                                "url(" +
                                n.default.active_metadata.cover_art_url +
                                ")");
                    }
                    function u(e, t, i) {
                        n.default.active_playlist == t &&
                            n.default.playlists[active_playlist].active_index ==
                                i &&
                            (e.style.backgroundImage =
                                "url(" +
                                n.default.active_metadata.cover_art_url +
                                ")");
                    }
                    return {
                        run: function () {
                            var a = document.querySelectorAll(
                                ".amplitude-visualization"
                            );
                            if (n.default.web_audio_api_available) {
                                if (
                                    Object.keys(
                                        n.default.visualizations.available
                                    ).length > 0 &&
                                    a.length > 0
                                )
                                    for (var d = 0; d < a.length; d++) {
                                        var c = a[d].getAttribute(
                                                "data-amplitude-playlist"
                                            ),
                                            h = a[d].getAttribute(
                                                "data-amplitude-song-index"
                                            );
                                        null == c && null == h && e(a[d]),
                                            null != c &&
                                                null == h &&
                                                t(a[d], c),
                                            null == c &&
                                                null != h &&
                                                i(a[d], h),
                                            null != c &&
                                                null != h &&
                                                s(a[d], c, h);
                                    }
                            } else
                                !(function () {
                                    var e = document.querySelectorAll(
                                        ".amplitude-visualization"
                                    );
                                    if (e.length > 0)
                                        for (var t = 0; t < e.length; t++) {
                                            var i = e[t].getAttribute(
                                                    "data-amplitude-playlist"
                                                ),
                                                n = e[t].getAttribute(
                                                    "data-amplitude-song-index"
                                                );
                                            null == i && null == n && r(e[t]),
                                                null != i &&
                                                    null == n &&
                                                    o(e[t], i),
                                                null == i &&
                                                    null != n &&
                                                    l(e[t], n),
                                                null != i &&
                                                    null != n &&
                                                    u(e[t], i, n);
                                        }
                                })();
                        },
                        stop: function () {
                            for (
                                var e = 0;
                                e < n.default.visualizations.active.length;
                                e++
                            )
                                n.default.visualizations.active[
                                    e
                                ].stopVisualization();
                            n.default.visualizations.active = [];
                        },
                        register: function (e, t) {
                            var i = new e();
                            (n.default.visualizations.available[i.getID()] =
                                new Array()),
                                (n.default.visualizations.available[
                                    i.getID()
                                ].object = e),
                                (n.default.visualizations.available[
                                    i.getID()
                                ].preferences = t);
                        },
                    };
                })();
                (t.default = a), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = a(i(0)),
                    s = a(i(21));
                function a(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var r = (function () {
                    var e = {};
                    function t() {
                        SC.initialize({
                            client_id: n.default.soundcloud_client,
                        }),
                            (function () {
                                for (
                                    var e =
                                            /^https?:\/\/(soundcloud.com|snd.sc)\/(.*)$/,
                                        t = 0;
                                    t < n.default.songs.length;
                                    t++
                                )
                                    n.default.songs[t].url.match(e) &&
                                        (n.default.soundcloud_song_count++,
                                        i(n.default.songs[t].url, t));
                            })();
                    }
                    function i(t, i) {
                        SC.get("/resolve/?url=" + t, function (t) {
                            t.streamable
                                ? ((n.default.songs[i].url =
                                      t.stream_url +
                                      "?client_id=" +
                                      n.default.soundcloud_client),
                                  n.default.soundcloud_use_art &&
                                      (n.default.songs[i].cover_art_url =
                                          t.artwork_url),
                                  (n.default.songs[i].soundcloud_data = t))
                                : AmplitudeHelpers.writeDebugMessage(
                                      n.default.songs[i].name +
                                          " by " +
                                          n.default.songs[i].artist +
                                          " is not streamable by the Soundcloud API"
                                  ),
                                n.default.soundcloud_songs_ready++,
                                n.default.soundcloud_songs_ready ==
                                    n.default.soundcloud_song_count &&
                                    s.default.setConfig(e);
                        });
                    }
                    return {
                        loadSoundCloud: function (i) {
                            e = i;
                            var n = document.getElementsByTagName("head")[0],
                                s = document.createElement("script");
                            (s.type = "text/javascript"),
                                (s.src =
                                    "https://connect.soundcloud.com/sdk.js"),
                                (s.onreadystatechange = t),
                                (s.onload = t),
                                n.appendChild(s);
                        },
                        resolveIndividualStreamableURL: function (e, t, i) {
                            var s =
                                arguments.length > 3 &&
                                void 0 !== arguments[3] &&
                                arguments[3];
                            SC.get("/resolve/?url=" + e, function (e) {
                                e.streamable
                                    ? null != t
                                        ? ((n.default.playlists[t].songs[
                                              i
                                          ].url =
                                              e.stream_url +
                                              "?client_id=" +
                                              n.default.soundcloud_client),
                                          s &&
                                              (n.default.playlists[
                                                  t
                                              ].shuffle_list[i].url =
                                                  e.stream_url +
                                                  "?client_id=" +
                                                  n.default.soundcloud_client),
                                          n.default.soundcloud_use_art &&
                                              ((n.default.playlists[t].songs[
                                                  i
                                              ].cover_art_url = e.artwork_url),
                                              s &&
                                                  (n.default.playlists[
                                                      t
                                                  ].shuffle_list[
                                                      i
                                                  ].cover_art_url =
                                                      e.artwork_url)),
                                          (n.default.playlists[t].songs[
                                              i
                                          ].soundcloud_data = e),
                                          s &&
                                              (n.default.playlists[
                                                  t
                                              ].shuffle_list[
                                                  i
                                              ].soundcloud_data = e))
                                        : ((n.default.songs[i].url =
                                              e.stream_url +
                                              "?client_id=" +
                                              n.default.soundcloud_client),
                                          s &&
                                              (n.default.shuffle_list[i]
                                                  .stream_url,
                                              n.default.soundcloud_client),
                                          n.default.soundcloud_use_art &&
                                              ((n.default.songs[
                                                  i
                                              ].cover_art_url = e.artwork_url),
                                              s &&
                                                  (n.default.shuffle_list[
                                                      i
                                                  ].cover_art_url =
                                                      e.artwork_url)),
                                          (n.default.songs[i].soundcloud_data =
                                              e),
                                          s &&
                                              (n.default.shuffle_list[
                                                  i
                                              ].soundcloud_data = e))
                                    : null != t
                                    ? AmplitudeHelpers.writeDebugMessage(
                                          n.default.playlists[t].songs[i].name +
                                              " by " +
                                              n.default.playlists[t].songs[i]
                                                  .artist +
                                              " is not streamable by the Soundcloud API"
                                      )
                                    : AmplitudeHelpers.writeDebugMessage(
                                          n.default.songs[i].name +
                                              " by " +
                                              n.default.songs[i].artist +
                                              " is not streamable by the Soundcloud API"
                                      );
                            });
                        },
                        isSoundCloudURL: function (e) {
                            return e.match(
                                /^https?:\/\/(soundcloud.com|snd.sc)\/(.*)$/
                            );
                        },
                    };
                })();
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = {
                    sync: function () {
                        for (
                            var e = document.getElementsByClassName(
                                    "amplitude-playback-speed"
                                ),
                                t = 0;
                            t < e.length;
                            t++
                        )
                            switch (
                                (e[t].classList.remove(
                                    "amplitude-playback-speed-10"
                                ),
                                e[t].classList.remove(
                                    "amplitude-playback-speed-15"
                                ),
                                e[t].classList.remove(
                                    "amplitude-playback-speed-20"
                                ),
                                a.default.playback_speed)
                            ) {
                                case 1:
                                    e[t].classList.add(
                                        "amplitude-playback-speed-10"
                                    );
                                    break;
                                case 1.5:
                                    e[t].classList.add(
                                        "amplitude-playback-speed-15"
                                    );
                                    break;
                                case 2:
                                    e[t].classList.add(
                                        "amplitude-playback-speed-20"
                                    );
                            }
                    },
                };
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = {
                    syncMain: function () {
                        for (
                            var e =
                                    document.getElementsByClassName(
                                        "amplitude-shuffle"
                                    ),
                                t = 0;
                            t < e.length;
                            t++
                        )
                            null ==
                                e[t].getAttribute("data-amplitude-playlist") &&
                                (a.default.shuffle_on
                                    ? (e[t].classList.add(
                                          "amplitude-shuffle-on"
                                      ),
                                      e[t].classList.remove(
                                          "amplitude-shuffle-off"
                                      ))
                                    : (e[t].classList.add(
                                          "amplitude-shuffle-off"
                                      ),
                                      e[t].classList.remove(
                                          "amplitude-shuffle-on"
                                      )));
                    },
                    syncPlaylist: function (e) {
                        for (
                            var t = document.querySelectorAll(
                                    '.amplitude-shuffle[data-amplitude-playlist="' +
                                        e +
                                        '"]'
                                ),
                                i = 0;
                            i < t.length;
                            i++
                        )
                            a.default.playlists[e].shuffle
                                ? (t[i].classList.add("amplitude-shuffle-on"),
                                  t[i].classList.remove(
                                      "amplitude-shuffle-off"
                                  ))
                                : (t[i].classList.add("amplitude-shuffle-off"),
                                  t[i].classList.remove(
                                      "amplitude-shuffle-on"
                                  ));
                    },
                };
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = {
                    sync: function (e) {
                        !(function (e) {
                            if (!isNaN(e))
                                for (
                                    var t = document.querySelectorAll(
                                            ".amplitude-song-played-progress"
                                        ),
                                        i = 0;
                                    i < t.length;
                                    i++
                                ) {
                                    var n = t[i].getAttribute(
                                            "data-amplitude-playlist"
                                        ),
                                        s = t[i].getAttribute(
                                            "data-amplitude-song-index"
                                        );
                                    if (null == n && null == s) {
                                        var a = t[i].max;
                                        t[i].value = (e / 100) * a;
                                    }
                                }
                        })(e),
                            (function (e) {
                                if (!isNaN(e))
                                    for (
                                        var t = document.querySelectorAll(
                                                '.amplitude-song-played-progress[data-amplitude-playlist="' +
                                                    a.default.active_playlist +
                                                    '"]'
                                            ),
                                            i = 0;
                                        i < t.length;
                                        i++
                                    )
                                        if (
                                            null ==
                                            t[i].getAttribute(
                                                "data-amplitude-song-index"
                                            )
                                        ) {
                                            var n = t[i].max;
                                            t[i].value = (e / 100) * n;
                                        }
                            })(e),
                            (function (e) {
                                if (
                                    null == a.default.active_playlist &&
                                    !isNaN(e)
                                )
                                    for (
                                        var t = document.querySelectorAll(
                                                '.amplitude-song-played-progress[data-amplitude-song-index="' +
                                                    a.default.active_index +
                                                    '"]'
                                            ),
                                            i = 0;
                                        i < t.length;
                                        i++
                                    )
                                        if (
                                            null ==
                                            t[i].getAttribute(
                                                "data-amplitude-playlist"
                                            )
                                        ) {
                                            var n = t[i].max;
                                            t[i].value = (e / 100) * n;
                                        }
                            })(e),
                            (function (e) {
                                if (!isNaN(e))
                                    for (
                                        var t =
                                                "" !=
                                                    a.default.active_playlist &&
                                                null !=
                                                    a.default.active_playlist
                                                    ? a.default.playlists[
                                                          a.default
                                                              .active_playlist
                                                      ].active_index
                                                    : null,
                                            i = document.querySelectorAll(
                                                '.amplitude-song-played-progress[data-amplitude-playlist="' +
                                                    a.default.active_playlist +
                                                    '"][data-amplitude-song-index="' +
                                                    t +
                                                    '"]'
                                            ),
                                            n = 0;
                                        n < i.length;
                                        n++
                                    ) {
                                        var s = i[n].getAttribute(
                                                "data-amplitude-playlist"
                                            ),
                                            r = i[n].getAttribute(
                                                "data-amplitude-song-index"
                                            );
                                        if (null != s && null != r) {
                                            var o = i[n].max;
                                            i[n].value = (e / 100) * o;
                                        }
                                    }
                            })(e);
                    },
                    resetElements: function () {
                        for (
                            var e = document.getElementsByClassName(
                                    "amplitude-song-played-progress"
                                ),
                                t = 0;
                            t < e.length;
                            t++
                        )
                            e[t].value = 0;
                    },
                };
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n =
                        "function" == typeof Symbol &&
                        "symbol" == typeof Symbol.iterator
                            ? function (e) {
                                  return typeof e;
                              }
                            : function (e) {
                                  return e &&
                                      "function" == typeof Symbol &&
                                      e.constructor === Symbol &&
                                      e !== Symbol.prototype
                                      ? "symbol"
                                      : typeof e;
                              },
                    s = k(i(0)),
                    a = k(i(1)),
                    r = k(i(17)),
                    o = k(i(6)),
                    l = k(i(4)),
                    u = k(i(5)),
                    d = k(i(13)),
                    c = k(i(26)),
                    h = k(i(46)),
                    f = k(i(16)),
                    p = k(i(22)),
                    m = k(i(3)),
                    g = k(i(9)),
                    v = k(i(48)),
                    y = k(i(19)),
                    b = k(i(10)),
                    _ = k(i(11)),
                    x = k(i(15)),
                    w = k(i(2)),
                    S = k(i(7)),
                    M = k(i(18)),
                    E = k(i(8));
                function k(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var T = (function () {
                    function e(e) {
                        e.playlists &&
                            (function (e) {
                                var t = 0,
                                    i = void 0;
                                for (i in e) e.hasOwnProperty(i) && t++;
                                return (
                                    l.default.writeMessage(
                                        "You have " +
                                            t +
                                            " playlist(s) in your config"
                                    ),
                                    t
                                );
                            })(e.playlists) > 0 &&
                            v.default.initialize(e.playlists),
                            null == e.start_song || e.starting_playlist
                                ? m.default.changeSong(s.default.songs[0], 0)
                                : u.default.isInt(e.start_song)
                                ? m.default.changeSong(
                                      s.default.songs[e.start_song],
                                      e.start_song
                                  )
                                : l.default.writeMessage(
                                      "You must enter an integer index for the start song."
                                  ),
                            null != e.shuffle_on &&
                                e.shuffle_on &&
                                ((s.default.shuffle_on = !0),
                                d.default.shuffleSongs(),
                                m.default.changeSong(
                                    s.default.shuffle_list[0],
                                    0
                                )),
                            (s.default.continue_next =
                                null == e.continue_next || e.continue_next),
                            (s.default.playback_speed =
                                null != e.playback_speed
                                    ? e.playback_speed
                                    : 1),
                            a.default.setPlaybackSpeed(
                                s.default.playback_speed
                            ),
                            (s.default.audio.preload =
                                null != e.preload ? e.preload : "auto"),
                            (s.default.callbacks =
                                null != e.callbacks ? e.callbacks : {}),
                            (s.default.bindings =
                                null != e.bindings ? e.bindings : {}),
                            (s.default.volume =
                                null != e.volume ? e.volume : 50),
                            (s.default.delay = null != e.delay ? e.delay : 0),
                            (s.default.volume_increment =
                                null != e.volume_increment
                                    ? e.volume_increment
                                    : 5),
                            (s.default.volume_decrement =
                                null != e.volume_decrement
                                    ? e.volume_decrement
                                    : 5),
                            a.default.setVolume(s.default.volume),
                            t(e),
                            y.default.syncMain(),
                            b.default.setMuted(0 == s.default.volume),
                            _.default.sync(),
                            M.default.sync(),
                            x.default.resetCurrentTimes(),
                            w.default.syncToPause(),
                            S.default.syncMetaData(),
                            E.default.syncRepeatSong(),
                            null != e.starting_playlist &&
                                "" != e.starting_playlist &&
                                ((s.default.active_playlist =
                                    e.starting_playlist),
                                null != e.starting_playlist_song &&
                                "" != e.starting_playlist_song
                                    ? null !=
                                      n(
                                          e.playlists[e.starting_playlist]
                                              .songs[
                                              parseInt(e.starting_playlist_song)
                                          ]
                                      )
                                        ? m.default.changeSongPlaylist(
                                              s.default.active_playlist,
                                              e.playlists[e.starting_playlist]
                                                  .songs[
                                                  parseInt(
                                                      e.starting_playlist_song
                                                  )
                                              ],
                                              parseInt(e.starting_playlist_song)
                                          )
                                        : (m.default.changeSongPlaylist(
                                              s.default.active_playlist,
                                              e.playlists[e.starting_playlist]
                                                  .songs[0],
                                              0
                                          ),
                                          l.default.writeMessage(
                                              "The index of " +
                                                  e.starting_playlist_song +
                                                  " does not exist in the playlist " +
                                                  e.starting_playlist
                                          ))
                                    : m.default.changeSong(
                                          s.default.active_playlist,
                                          e.playlists[e.starting_playlist]
                                              .songs[0],
                                          0
                                      ),
                                w.default.sync()),
                            g.default.run("initialized");
                    }
                    function t(e) {
                        null != e.default_album_art
                            ? (s.default.default_album_art =
                                  e.default_album_art)
                            : (s.default.default_album_art = ""),
                            null != e.default_playlist_art
                                ? (s.default.default_playlist_art =
                                      e.default_playlist_art)
                                : (s.default.default_playlist_art = "");
                    }
                    return {
                        initialize: function (i) {
                            var n = !1;
                            if (
                                (o.default.resetConfig(),
                                c.default.initialize(),
                                g.default.initialize(),
                                (s.default.debug = null != i.debug && i.debug),
                                t(i),
                                i.songs
                                    ? 0 != i.songs.length
                                        ? ((s.default.songs = i.songs),
                                          (n = !0))
                                        : l.default.writeMessage(
                                              "Please add some songs, to your songs object!"
                                          )
                                    : l.default.writeMessage(
                                          "Please provide a songs object for AmplitudeJS to run!"
                                      ),
                                h.default.webAudioAPIAvailable())
                            ) {
                                if (
                                    h.default.determineUsingAnyFX() &&
                                    (h.default.configureWebAudioAPI(),
                                    document.documentElement.addEventListener(
                                        "mousedown",
                                        function () {
                                            "running" !==
                                                s.default.context.state &&
                                                s.default.context.resume();
                                        }
                                    ),
                                    document.documentElement.addEventListener(
                                        "keydown",
                                        function () {
                                            "running" !==
                                                s.default.context.state &&
                                                s.default.context.resume();
                                        }
                                    ),
                                    document.documentElement.addEventListener(
                                        "keyup",
                                        function () {
                                            "running" !==
                                                s.default.context.state &&
                                                s.default.context.resume();
                                        }
                                    ),
                                    null != i.waveforms &&
                                        null != i.waveforms.sample_rate &&
                                        (s.default.waveforms.sample_rate =
                                            i.waveforms.sample_rate),
                                    p.default.init(),
                                    null != i.visualizations &&
                                        i.visualizations.length > 0)
                                )
                                    for (
                                        var a = 0;
                                        a < i.visualizations.length;
                                        a++
                                    )
                                        f.default.register(
                                            i.visualizations[a].object,
                                            i.visualizations[a].params
                                        );
                            } else
                                l.default.writeMessage(
                                    "The Web Audio API is not available on this platform. We are using your defined backups!"
                                );
                            if (
                                ((function () {
                                    for (
                                        var e = 0;
                                        e < s.default.songs.length;
                                        e++
                                    )
                                        null == s.default.songs[e].live &&
                                            (s.default.songs[e].live = !1);
                                })(),
                                (function () {
                                    for (
                                        var e = 0;
                                        e < s.default.songs.length;
                                        e++
                                    )
                                        s.default.songs[e].index = e;
                                })(),
                                n)
                            ) {
                                (s.default.soundcloud_client =
                                    null != i.soundcloud_client
                                        ? i.soundcloud_client
                                        : ""),
                                    (s.default.soundcloud_use_art =
                                        null != i.soundcloud_use_art
                                            ? i.soundcloud_use_art
                                            : "");
                                var u = {};
                                "" != s.default.soundcloud_client
                                    ? ((u = i), r.default.loadSoundCloud(u))
                                    : e(i);
                            }
                            l.default.writeMessage("Initialized With: "),
                                l.default.writeMessage(s.default);
                        },
                        setConfig: e,
                        rebindDisplay: function () {
                            c.default.initialize(), S.default.displayMetaData();
                        },
                    };
                })();
                (t.default = T), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = (function () {
                    var e = "",
                        t = "",
                        i = "";
                    function n(e) {
                        for (
                            var t = document.querySelectorAll(
                                    ".amplitude-wave-form"
                                ),
                                i = 0;
                            i < t.length;
                            i++
                        ) {
                            var n = t[i].getAttribute(
                                    "data-amplitude-playlist"
                                ),
                                a = t[i].getAttribute(
                                    "data-amplitude-song-index"
                                );
                            null == n && null == a && s(t[i], e),
                                null != n && null == a && r(t[i], e, n),
                                null == n && null != a && o(t[i], e, a),
                                null != n && null != a && l(t[i], e, n, a);
                        }
                    }
                    function s(e, t) {
                        e.querySelector("svg g path").setAttribute("d", t);
                    }
                    function r(e, t, i) {
                        a.default.active_playlist == i &&
                            e.querySelector("svg g path").setAttribute("d", t);
                    }
                    function o(e, t, i) {
                        a.default.active_index == i &&
                            e.querySelector("svg g path").setAttribute("d", t);
                    }
                    function l(e, t, i, n) {
                        a.default.active_playlist == i &&
                            a.default.playlists[a.default.active_playlist]
                                .active_index == n &&
                            e.querySelector("svg g path").setAttribute("d", t);
                    }
                    return {
                        init: function () {
                            t = a.default.waveforms.sample_rate;
                            var e = document.querySelectorAll(
                                ".amplitude-wave-form"
                            );
                            if (e.length > 0)
                                for (var i = 0; i < e.length; i++) {
                                    e[i].innerHTML = "";
                                    var n = document.createElementNS(
                                        "http://www.w3.org/2000/svg",
                                        "svg"
                                    );
                                    n.setAttribute(
                                        "viewBox",
                                        "0 -1 " + t + " 2"
                                    ),
                                        n.setAttribute(
                                            "preserveAspectRatio",
                                            "none"
                                        );
                                    var s = document.createElementNS(
                                        "http://www.w3.org/2000/svg",
                                        "g"
                                    );
                                    n.appendChild(s);
                                    var r = document.createElementNS(
                                        "http://www.w3.org/2000/svg",
                                        "path"
                                    );
                                    r.setAttribute("d", ""),
                                        r.setAttribute("id", "waveform"),
                                        s.appendChild(r),
                                        e[i].appendChild(n);
                                }
                        },
                        build: function () {
                            if (a.default.web_audio_api_available)
                                if (
                                    null ==
                                    a.default.waveforms.built[
                                        Math.abs(
                                            a.default.audio.src
                                                .split("")
                                                .reduce(function (e, t) {
                                                    return (
                                                        (e =
                                                            (e << 5) -
                                                            e +
                                                            t.charCodeAt(0)) & e
                                                    );
                                                }, 0)
                                        )
                                    ]
                                ) {
                                    var s = new XMLHttpRequest();
                                    s.open("GET", a.default.audio.src, !0),
                                        (s.responseType = "arraybuffer"),
                                        (s.onreadystatechange = function (r) {
                                            4 == s.readyState &&
                                                200 == s.status &&
                                                a.default.context.decodeAudioData(
                                                    s.response,
                                                    function (s) {
                                                        (i = (function (e, t) {
                                                            for (
                                                                var i =
                                                                        t.length /
                                                                        e,
                                                                    n =
                                                                        ~~(
                                                                            i /
                                                                            10
                                                                        ) || 1,
                                                                    s =
                                                                        t.numberOfChannels,
                                                                    a = [],
                                                                    r = 0;
                                                                r < s;
                                                                r++
                                                            )
                                                                for (
                                                                    var o = [],
                                                                        l =
                                                                            t.getChannelData(
                                                                                r
                                                                            ),
                                                                        u = 0;
                                                                    u < e;
                                                                    u++
                                                                ) {
                                                                    for (
                                                                        var d =
                                                                                ~~(
                                                                                    u *
                                                                                    i
                                                                                ),
                                                                            c =
                                                                                ~~(
                                                                                    d +
                                                                                    i
                                                                                ),
                                                                            h =
                                                                                l[0],
                                                                            f =
                                                                                l[0],
                                                                            p =
                                                                                d;
                                                                        p < c;
                                                                        p += n
                                                                    ) {
                                                                        var m =
                                                                            l[
                                                                                p
                                                                            ];
                                                                        m > f &&
                                                                            (f =
                                                                                m),
                                                                            m <
                                                                                h &&
                                                                                (h =
                                                                                    m);
                                                                    }
                                                                    (o[2 * u] =
                                                                        f),
                                                                        (o[
                                                                            2 *
                                                                                u +
                                                                                1
                                                                        ] = h),
                                                                        (0 ===
                                                                            r ||
                                                                            f >
                                                                                a[
                                                                                    2 *
                                                                                        u
                                                                                ]) &&
                                                                            (a[
                                                                                2 *
                                                                                    u
                                                                            ] =
                                                                                f),
                                                                        (0 ===
                                                                            r ||
                                                                            h <
                                                                                a[
                                                                                    2 *
                                                                                        u +
                                                                                        1
                                                                                ]) &&
                                                                            (a[
                                                                                2 *
                                                                                    u +
                                                                                    1
                                                                            ] =
                                                                                h);
                                                                }
                                                            return a;
                                                        })(t, (e = s))),
                                                            (function (
                                                                e,
                                                                t,
                                                                i
                                                            ) {
                                                                if (t) {
                                                                    for (
                                                                        var s =
                                                                                i.length,
                                                                            r =
                                                                                "",
                                                                            o = 0;
                                                                        o < s;
                                                                        o++
                                                                    )
                                                                        r +=
                                                                            o %
                                                                                2 ==
                                                                            0
                                                                                ? " M" +
                                                                                  ~~(
                                                                                      o /
                                                                                      2
                                                                                  ) +
                                                                                  ", " +
                                                                                  i.shift()
                                                                                : " L" +
                                                                                  ~~(
                                                                                      o /
                                                                                      2
                                                                                  ) +
                                                                                  ", " +
                                                                                  i.shift();
                                                                    (a.default.waveforms.built[
                                                                        Math.abs(
                                                                            a.default.audio.src
                                                                                .split(
                                                                                    ""
                                                                                )
                                                                                .reduce(
                                                                                    function (
                                                                                        e,
                                                                                        t
                                                                                    ) {
                                                                                        return (
                                                                                            (e =
                                                                                                (e <<
                                                                                                    5) -
                                                                                                e +
                                                                                                t.charCodeAt(
                                                                                                    0
                                                                                                )) &
                                                                                            e
                                                                                        );
                                                                                    },
                                                                                    0
                                                                                )
                                                                        )
                                                                    ] = r),
                                                                        n(
                                                                            a
                                                                                .default
                                                                                .waveforms
                                                                                .built[
                                                                                Math.abs(
                                                                                    a.default.audio.src
                                                                                        .split(
                                                                                            ""
                                                                                        )
                                                                                        .reduce(
                                                                                            function (
                                                                                                e,
                                                                                                t
                                                                                            ) {
                                                                                                return (
                                                                                                    (e =
                                                                                                        (e <<
                                                                                                            5) -
                                                                                                        e +
                                                                                                        t.charCodeAt(
                                                                                                            0
                                                                                                        )) &
                                                                                                    e
                                                                                                );
                                                                                            },
                                                                                            0
                                                                                        )
                                                                                )
                                                                            ]
                                                                        );
                                                                }
                                                            })(0, e, i);
                                                    }
                                                );
                                        }),
                                        s.send();
                                } else
                                    n(
                                        a.default.waveforms.built[
                                            Math.abs(
                                                a.default.audio.src
                                                    .split("")
                                                    .reduce(function (e, t) {
                                                        return (
                                                            (e =
                                                                (e << 5) -
                                                                e +
                                                                t.charCodeAt(
                                                                    0
                                                                )) & e
                                                        );
                                                    }, 0)
                                            )
                                        ]
                                    );
                        },
                        determineIfUsingWaveforms: function () {
                            return (
                                document.querySelectorAll(
                                    ".amplitude-wave-form"
                                ).length > 0
                            );
                        },
                    };
                })();
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = {
                    computeCurrentTimes: function () {
                        var e = {},
                            t =
                                (Math.floor(a.default.audio.currentTime % 60) <
                                10
                                    ? "0"
                                    : "") +
                                Math.floor(a.default.audio.currentTime % 60),
                            i = Math.floor(a.default.audio.currentTime / 60),
                            n = "00";
                        return (
                            i < 10 && (i = "0" + i),
                            i >= 60 &&
                                ((n = Math.floor(i / 60)),
                                (i %= 60) < 10 && (i = "0" + i)),
                            (e.seconds = t),
                            (e.minutes = i),
                            (e.hours = n),
                            e
                        );
                    },
                    computeSongDuration: function () {
                        var e = {},
                            t =
                                (Math.floor(a.default.audio.duration % 60) < 10
                                    ? "0"
                                    : "") +
                                Math.floor(a.default.audio.duration % 60),
                            i = Math.floor(a.default.audio.duration / 60),
                            n = "00";
                        return (
                            i < 10 && (i = "0" + i),
                            i >= 60 &&
                                ((n = Math.floor(i / 60)),
                                (i %= 60) < 10 && (i = "0" + i)),
                            (e.seconds = isNaN(t) ? "00" : t),
                            (e.minutes = isNaN(i) ? "00" : i),
                            (e.hours = isNaN(n) ? "00" : n.toString()),
                            e
                        );
                    },
                    computeSongCompletionPercentage: function () {
                        return (
                            (a.default.audio.currentTime /
                                a.default.audio.duration) *
                            100
                        );
                    },
                    setCurrentTime: function (e) {
                        a.default.active_metadata.live ||
                            (isFinite(e) && (a.default.audio.currentTime = e));
                    },
                };
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = {
                    sync: function () {
                        !(function () {
                            for (
                                var e = document.getElementsByClassName(
                                        "amplitude-buffered-progress"
                                    ),
                                    t = 0;
                                t < e.length;
                                t++
                            ) {
                                var i = e[t].getAttribute(
                                        "data-amplitude-playlist"
                                    ),
                                    n = e[t].getAttribute(
                                        "data-amplitude-song-index"
                                    );
                                null != i ||
                                    null != n ||
                                    isNaN(a.default.buffered) ||
                                    (e[t].value = parseFloat(
                                        parseFloat(a.default.buffered) / 100
                                    ));
                            }
                        })(),
                            (function () {
                                for (
                                    var e = document.querySelectorAll(
                                            '.amplitude-buffered-progress[data-amplitude-playlist="' +
                                                a.default.active_playlist +
                                                '"]'
                                        ),
                                        t = 0;
                                    t < e.length;
                                    t++
                                )
                                    null !=
                                        e[t].getAttribute(
                                            "data-amplitude-song-index"
                                        ) ||
                                        isNaN(a.default.buffered) ||
                                        (e[t].value = parseFloat(
                                            parseFloat(a.default.buffered) / 100
                                        ));
                            })(),
                            (function () {
                                for (
                                    var e = document.querySelectorAll(
                                            '.amplitude-buffered-progress[data-amplitude-song-index="' +
                                                a.default.active_index +
                                                '"]'
                                        ),
                                        t = 0;
                                    t < e.length;
                                    t++
                                )
                                    null !=
                                        e[t].getAttribute(
                                            "data-amplitude-playlist"
                                        ) ||
                                        isNaN(a.default.buffered) ||
                                        (e[t].value = parseFloat(
                                            parseFloat(a.default.buffered) / 100
                                        ));
                            })(),
                            (function () {
                                for (
                                    var e =
                                            null != a.default.active_playlist &&
                                            "" != a.default.active_playlist
                                                ? a.default.playlists[
                                                      a.default.active_playlist
                                                  ].active_index
                                                : null,
                                        t = document.querySelectorAll(
                                            '.amplitude-buffered-progress[data-amplitude-song-index="' +
                                                e +
                                                '"][data-amplitude-playlist="' +
                                                a.default.active_playlist +
                                                '"]'
                                        ),
                                        i = 0;
                                    i < t.length;
                                    i++
                                )
                                    isNaN(a.default.buffered) ||
                                        (t[i].value = parseFloat(
                                            parseFloat(a.default.buffered) / 100
                                        ));
                            })();
                    },
                    reset: function () {
                        for (
                            var e = document.getElementsByClassName(
                                    "amplitude-buffered-progress"
                                ),
                                t = 0;
                            t < e.length;
                            t++
                        )
                            e[t].value = 0;
                    },
                };
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = o(i(0)),
                    s = o(i(3)),
                    a = o(i(1)),
                    r = o(i(2));
                function o(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var l = {
                    handle: function () {
                        setTimeout(function () {
                            n.default.continue_next
                                ? "" == n.default.active_playlist ||
                                  null == n.default.active_playlist
                                    ? s.default.setNext(!0)
                                    : s.default.setNextPlaylist(
                                          n.default.active_playlist,
                                          !0
                                      )
                                : n.default.is_touch_moving ||
                                  (a.default.stop(), r.default.sync());
                        }, n.default.delay);
                    },
                };
                (t.default = l), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = k(i(0)),
                    s = k(i(27)),
                    a = k(i(42)),
                    r = k(i(25)),
                    o = k(i(35)),
                    l = k(i(31)),
                    u = k(i(30)),
                    d = k(i(32)),
                    c = k(i(41)),
                    h = k(i(28)),
                    f = k(i(45)),
                    p = k(i(43)),
                    m = k(i(40)),
                    g = k(i(44)),
                    v = k(i(29)),
                    y = k(i(34)),
                    b = k(i(36)),
                    _ = k(i(37)),
                    x = k(i(33)),
                    w = k(i(38)),
                    S = k(i(39)),
                    M = k(i(22)),
                    E = k(i(4));
                function k(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var T = {
                    initialize: function () {
                        E.default.writeMessage(
                            "Beginning initialization of event handlers.."
                        ),
                            document.addEventListener("touchmove", function () {
                                n.default.is_touch_moving = !0;
                            }),
                            document.addEventListener("touchend", function () {
                                n.default.is_touch_moving &&
                                    (n.default.is_touch_moving = !1);
                            }),
                            n.default.audio.removeEventListener(
                                "timeupdate",
                                a.default.handle
                            ),
                            n.default.audio.addEventListener(
                                "timeupdate",
                                a.default.handle
                            ),
                            n.default.audio.removeEventListener(
                                "durationchange",
                                a.default.handle
                            ),
                            n.default.audio.addEventListener(
                                "durationchange",
                                a.default.handle
                            ),
                            document.removeEventListener(
                                "keydown",
                                s.default.handle
                            ),
                            document.addEventListener(
                                "keydown",
                                s.default.handle
                            ),
                            n.default.audio.removeEventListener(
                                "ended",
                                r.default.handle
                            ),
                            n.default.audio.addEventListener(
                                "ended",
                                r.default.handle
                            ),
                            n.default.audio.removeEventListener(
                                "progress",
                                o.default.handle
                            ),
                            n.default.audio.addEventListener(
                                "progress",
                                o.default.handle
                            ),
                            (function () {
                                for (
                                    var e =
                                            document.getElementsByClassName(
                                                "amplitude-play"
                                            ),
                                        t = 0;
                                    t < e.length;
                                    t++
                                )
                                    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                                        navigator.userAgent
                                    )
                                        ? (e[t].removeEventListener(
                                              "touchend",
                                              l.default.handle
                                          ),
                                          e[t].addEventListener(
                                              "touchend",
                                              l.default.handle
                                          ))
                                        : (e[t].removeEventListener(
                                              "click",
                                              l.default.handle
                                          ),
                                          e[t].addEventListener(
                                              "click",
                                              l.default.handle
                                          ));
                            })(),
                            (function () {
                                for (
                                    var e =
                                            document.getElementsByClassName(
                                                "amplitude-pause"
                                            ),
                                        t = 0;
                                    t < e.length;
                                    t++
                                )
                                    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                                        navigator.userAgent
                                    )
                                        ? (e[t].removeEventListener(
                                              "touchend",
                                              u.default.handle
                                          ),
                                          e[t].addEventListener(
                                              "touchend",
                                              u.default.handle
                                          ))
                                        : (e[t].removeEventListener(
                                              "click",
                                              u.default.handle
                                          ),
                                          e[t].addEventListener(
                                              "click",
                                              u.default.handle
                                          ));
                            })(),
                            (function () {
                                for (
                                    var e = document.getElementsByClassName(
                                            "amplitude-play-pause"
                                        ),
                                        t = 0;
                                    t < e.length;
                                    t++
                                )
                                    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                                        navigator.userAgent
                                    )
                                        ? (e[t].removeEventListener(
                                              "touchend",
                                              d.default.handle
                                          ),
                                          e[t].addEventListener(
                                              "touchend",
                                              d.default.handle
                                          ))
                                        : (e[t].removeEventListener(
                                              "click",
                                              d.default.handle
                                          ),
                                          e[t].addEventListener(
                                              "click",
                                              d.default.handle
                                          ));
                            })(),
                            (function () {
                                for (
                                    var e =
                                            document.getElementsByClassName(
                                                "amplitude-stop"
                                            ),
                                        t = 0;
                                    t < e.length;
                                    t++
                                )
                                    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                                        navigator.userAgent
                                    )
                                        ? (e[t].removeEventListener(
                                              "touchend",
                                              c.default.handle
                                          ),
                                          e[t].addEventListener(
                                              "touchend",
                                              c.default.handle
                                          ))
                                        : (e[t].removeEventListener(
                                              "click",
                                              c.default.handle
                                          ),
                                          e[t].addEventListener(
                                              "click",
                                              c.default.handle
                                          ));
                            })(),
                            (function () {
                                for (
                                    var e =
                                            document.getElementsByClassName(
                                                "amplitude-mute"
                                            ),
                                        t = 0;
                                    t < e.length;
                                    t++
                                )
                                    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                                        navigator.userAgent
                                    )
                                        ? /iPhone|iPad|iPod/i.test(
                                              navigator.userAgent
                                          )
                                            ? E.default.writeMessage(
                                                  "iOS does NOT allow volume to be set through javascript: https://developer.apple.com/library/safari/documentation/AudioVideo/Conceptual/Using_HTML5_Audio_Video/Device-SpecificConsiderations/Device-SpecificConsiderations.html#//apple_ref/doc/uid/TP40009523-CH5-SW4"
                                              )
                                            : (e[t].removeEventListener(
                                                  "touchend",
                                                  h.default.handle
                                              ),
                                              e[t].addEventListener(
                                                  "touchend",
                                                  h.default.handle
                                              ))
                                        : (e[t].removeEventListener(
                                              "click",
                                              h.default.handle
                                          ),
                                          e[t].addEventListener(
                                              "click",
                                              h.default.handle
                                          ));
                            })(),
                            (function () {
                                for (
                                    var e = document.getElementsByClassName(
                                            "amplitude-volume-up"
                                        ),
                                        t = 0;
                                    t < e.length;
                                    t++
                                )
                                    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                                        navigator.userAgent
                                    )
                                        ? /iPhone|iPad|iPod/i.test(
                                              navigator.userAgent
                                          )
                                            ? E.default.writeMessage(
                                                  "iOS does NOT allow volume to be set through javascript: https://developer.apple.com/library/safari/documentation/AudioVideo/Conceptual/Using_HTML5_Audio_Video/Device-SpecificConsiderations/Device-SpecificConsiderations.html#//apple_ref/doc/uid/TP40009523-CH5-SW4"
                                              )
                                            : (e[t].removeEventListener(
                                                  "touchend",
                                                  f.default.handle
                                              ),
                                              e[t].addEventListener(
                                                  "touchend",
                                                  f.default.handle
                                              ))
                                        : (e[t].removeEventListener(
                                              "click",
                                              f.default.handle
                                          ),
                                          e[t].addEventListener(
                                              "click",
                                              f.default.handle
                                          ));
                            })(),
                            (function () {
                                for (
                                    var e = document.getElementsByClassName(
                                            "amplitude-volume-down"
                                        ),
                                        t = 0;
                                    t < e.length;
                                    t++
                                )
                                    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                                        navigator.userAgent
                                    )
                                        ? /iPhone|iPad|iPod/i.test(
                                              navigator.userAgent
                                          )
                                            ? E.default.writeMessage(
                                                  "iOS does NOT allow volume to be set through javascript: https://developer.apple.com/library/safari/documentation/AudioVideo/Conceptual/Using_HTML5_Audio_Video/Device-SpecificConsiderations/Device-SpecificConsiderations.html#//apple_ref/doc/uid/TP40009523-CH5-SW4"
                                              )
                                            : (e[t].removeEventListener(
                                                  "touchend",
                                                  p.default.handle
                                              ),
                                              e[t].addEventListener(
                                                  "touchend",
                                                  p.default.handle
                                              ))
                                        : (e[t].removeEventListener(
                                              "click",
                                              p.default.handle
                                          ),
                                          e[t].addEventListener(
                                              "click",
                                              p.default.handle
                                          ));
                            })(),
                            (function () {
                                for (
                                    var e =
                                            window.navigator.userAgent.indexOf(
                                                "MSIE "
                                            ),
                                        t = document.getElementsByClassName(
                                            "amplitude-song-slider"
                                        ),
                                        i = 0;
                                    i < t.length;
                                    i++
                                )
                                    e > 0 ||
                                    navigator.userAgent.match(
                                        /Trident.*rv\:11\./
                                    )
                                        ? (t[i].removeEventListener(
                                              "change",
                                              m.default.handle
                                          ),
                                          t[i].addEventListener(
                                              "change",
                                              m.default.handle
                                          ))
                                        : (t[i].removeEventListener(
                                              "input",
                                              m.default.handle
                                          ),
                                          t[i].addEventListener(
                                              "input",
                                              m.default.handle
                                          ));
                            })(),
                            (function () {
                                for (
                                    var e =
                                            window.navigator.userAgent.indexOf(
                                                "MSIE "
                                            ),
                                        t = document.getElementsByClassName(
                                            "amplitude-volume-slider"
                                        ),
                                        i = 0;
                                    i < t.length;
                                    i++
                                )
                                    /iPhone|iPad|iPod/i.test(
                                        navigator.userAgent
                                    )
                                        ? E.default.writeMessage(
                                              "iOS does NOT allow volume to be set through javascript: https://developer.apple.com/library/safari/documentation/AudioVideo/Conceptual/Using_HTML5_Audio_Video/Device-SpecificConsiderations/Device-SpecificConsiderations.html#//apple_ref/doc/uid/TP40009523-CH5-SW4"
                                          )
                                        : e > 0 ||
                                          navigator.userAgent.match(
                                              /Trident.*rv\:11\./
                                          )
                                        ? (t[i].removeEventListener(
                                              "change",
                                              g.default.handle
                                          ),
                                          t[i].addEventListener(
                                              "change",
                                              g.default.handle
                                          ))
                                        : (t[i].removeEventListener(
                                              "input",
                                              g.default.handle
                                          ),
                                          t[i].addEventListener(
                                              "input",
                                              g.default.handle
                                          ));
                            })(),
                            (function () {
                                for (
                                    var e =
                                            document.getElementsByClassName(
                                                "amplitude-next"
                                            ),
                                        t = 0;
                                    t < e.length;
                                    t++
                                )
                                    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                                        navigator.userAgent
                                    )
                                        ? (e[t].removeEventListener(
                                              "touchend",
                                              v.default.handle
                                          ),
                                          e[t].addEventListener(
                                              "touchend",
                                              v.default.handle
                                          ))
                                        : (e[t].removeEventListener(
                                              "click",
                                              v.default.handle
                                          ),
                                          e[t].addEventListener(
                                              "click",
                                              v.default.handle
                                          ));
                            })(),
                            (function () {
                                for (
                                    var e =
                                            document.getElementsByClassName(
                                                "amplitude-prev"
                                            ),
                                        t = 0;
                                    t < e.length;
                                    t++
                                )
                                    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                                        navigator.userAgent
                                    )
                                        ? (e[t].removeEventListener(
                                              "touchend",
                                              y.default.handle
                                          ),
                                          e[t].addEventListener(
                                              "touchend",
                                              y.default.handle
                                          ))
                                        : (e[t].removeEventListener(
                                              "click",
                                              y.default.handle
                                          ),
                                          e[t].addEventListener(
                                              "click",
                                              y.default.handle
                                          ));
                            })(),
                            (function () {
                                for (
                                    var e =
                                            document.getElementsByClassName(
                                                "amplitude-shuffle"
                                            ),
                                        t = 0;
                                    t < e.length;
                                    t++
                                )
                                    e[t].classList.remove(
                                        "amplitude-shuffle-on"
                                    ),
                                        e[t].classList.add(
                                            "amplitude-shuffle-off"
                                        ),
                                        /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                                            navigator.userAgent
                                        )
                                            ? (e[t].removeEventListener(
                                                  "touchend",
                                                  w.default.handle
                                              ),
                                              e[t].addEventListener(
                                                  "touchend",
                                                  w.default.handle
                                              ))
                                            : (e[t].removeEventListener(
                                                  "click",
                                                  w.default.handle
                                              ),
                                              e[t].addEventListener(
                                                  "click",
                                                  w.default.handle
                                              ));
                            })(),
                            (function () {
                                for (
                                    var e =
                                            document.getElementsByClassName(
                                                "amplitude-repeat"
                                            ),
                                        t = 0;
                                    t < e.length;
                                    t++
                                )
                                    e[t].classList.remove(
                                        "amplitude-repeat-on"
                                    ),
                                        e[t].classList.add(
                                            "amplitude-repeat-off"
                                        ),
                                        /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                                            navigator.userAgent
                                        )
                                            ? (e[t].removeEventListener(
                                                  "touchend",
                                                  b.default.handle
                                              ),
                                              e[t].addEventListener(
                                                  "touchend",
                                                  b.default.handle
                                              ))
                                            : (e[t].removeEventListener(
                                                  "click",
                                                  b.default.handle
                                              ),
                                              e[t].addEventListener(
                                                  "click",
                                                  b.default.handle
                                              ));
                            })(),
                            (function () {
                                for (
                                    var e = document.getElementsByClassName(
                                            "amplitude-repeat-song"
                                        ),
                                        t = 0;
                                    t < e.length;
                                    t++
                                )
                                    e[t].classList.remove(
                                        "amplitude-repeat-on"
                                    ),
                                        e[t].classList.add(
                                            "amplitude-repeat-off"
                                        ),
                                        /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                                            navigator.userAgent
                                        )
                                            ? (e[t].removeEventListener(
                                                  "touchend",
                                                  _.default.handle
                                              ),
                                              e[t].addEventListener(
                                                  "touchend",
                                                  _.default.handle
                                              ))
                                            : (e[t].removeEventListener(
                                                  "click",
                                                  _.default.handle
                                              ),
                                              e[t].addEventListener(
                                                  "click",
                                                  _.default.handle
                                              ));
                            })(),
                            (function () {
                                for (
                                    var e = document.getElementsByClassName(
                                            "amplitude-playback-speed"
                                        ),
                                        t = 0;
                                    t < e.length;
                                    t++
                                )
                                    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                                        navigator.userAgent
                                    )
                                        ? (e[t].removeEventListener(
                                              "touchend",
                                              x.default.handle
                                          ),
                                          e[t].addEventListener(
                                              "touchend",
                                              x.default.handle
                                          ))
                                        : (e[t].removeEventListener(
                                              "click",
                                              x.default.handle
                                          ),
                                          e[t].addEventListener(
                                              "click",
                                              x.default.handle
                                          ));
                            })(),
                            (function () {
                                for (
                                    var e =
                                            document.getElementsByClassName(
                                                "amplitude-skip-to"
                                            ),
                                        t = 0;
                                    t < e.length;
                                    t++
                                )
                                    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                                        navigator.userAgent
                                    )
                                        ? (e[t].removeEventListener(
                                              "touchend",
                                              S.default.handle
                                          ),
                                          e[t].addEventListener(
                                              "touchend",
                                              S.default.handle
                                          ))
                                        : (e[t].removeEventListener(
                                              "click",
                                              S.default.handle
                                          ),
                                          e[t].addEventListener(
                                              "click",
                                              S.default.handle
                                          ));
                            })(),
                            M.default.determineIfUsingWaveforms() &&
                                (n.default.audio.removeEventListener(
                                    "canplaythrough",
                                    M.default.build
                                ),
                                n.default.audio.addEventListener(
                                    "canplaythrough",
                                    M.default.build
                                ));
                    },
                };
                (t.default = T), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = d(i(0)),
                    s = d(i(1)),
                    a = d(i(13)),
                    r = d(i(12)),
                    o = d(i(3)),
                    l = d(i(8)),
                    u = d(i(2));
                function d(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var c = {
                    handle: function (e) {
                        !(function (e) {
                            if (null != n.default.bindings[e])
                                switch (n.default.bindings[e]) {
                                    case "play_pause":
                                        n.default.audio.paused
                                            ? s.default.play()
                                            : s.default.pause(),
                                            u.default.sync();
                                        break;
                                    case "next":
                                        "" == n.default.active_playlist ||
                                        null == n.default.active_playlist
                                            ? o.default.setNext()
                                            : o.default.setNextPlaylist(
                                                  n.default.active_playlist
                                              );
                                        break;
                                    case "prev":
                                        "" == n.default.active_playlist ||
                                        null == n.default.active_playlist
                                            ? o.default.setPrevious()
                                            : o.default.setPreviousPlaylist(
                                                  n.default.active_playlist
                                              );
                                        break;
                                    case "stop":
                                        u.default.syncToPause(),
                                            s.default.stop();
                                        break;
                                    case "shuffle":
                                        "" == n.default.active_playlist ||
                                        null == n.default.active_playlist
                                            ? a.default.toggleShuffle()
                                            : a.default.toggleShufflePlaylist(
                                                  n.default.active_playlist
                                              );
                                        break;
                                    case "repeat":
                                        r.default.setRepeat(!n.default.repeat),
                                            l.default.syncRepeat();
                                }
                        })(e.which);
                    },
                };
                (t.default = c), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = o(i(0)),
                    s = o(i(1)),
                    a = o(i(10)),
                    r = o(i(11));
                function o(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var l = {
                    handle: function () {
                        n.default.is_touch_moving ||
                            (0 == n.default.volume
                                ? s.default.setVolume(n.default.pre_mute_volume)
                                : ((n.default.pre_mute_volume =
                                      n.default.volume),
                                  s.default.setVolume(0)),
                            a.default.setMuted(0 == n.default.volume),
                            r.default.sync());
                    },
                };
                (t.default = l), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = r(i(0)),
                    s = (r(i(1)), r(i(2)), r(i(9)), r(i(3))),
                    a = r(i(4));
                function r(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var o = {
                    handle: function () {
                        if (!n.default.is_touch_moving) {
                            var e = this.getAttribute(
                                "data-amplitude-playlist"
                            );
                            null == e &&
                                ("" == n.default.active_playlist ||
                                null == n.default.active_playlist
                                    ? s.default.setNext()
                                    : s.default.setNextPlaylist(
                                          n.default.active_playlist
                                      )),
                                null != e &&
                                    (function (e) {
                                        e == n.default.active_playlist
                                            ? s.default.setNextPlaylist(e)
                                            : a.default.writeMessage(
                                                  "You can not go to the next song on a playlist that is not being played!"
                                              );
                                    })(e);
                        }
                    },
                };
                (t.default = o), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = r(i(0)),
                    s = (r(i(6)), r(i(1))),
                    a = r(i(2));
                function r(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var o = {
                    handle: function () {
                        if (!n.default.is_touch_moving) {
                            var e = this.getAttribute(
                                    "data-amplitude-song-index"
                                ),
                                t = this.getAttribute(
                                    "data-amplitude-playlist"
                                );
                            null == t &&
                                null == e &&
                                (s.default.pause(), a.default.sync()),
                                null != t &&
                                    null == e &&
                                    ((r = t),
                                    n.default.active_playlist == r &&
                                        (s.default.pause(), a.default.sync())),
                                null == t &&
                                    null != e &&
                                    ((i = e),
                                    ("" != n.default.active_playlist &&
                                        null != n.default.active_playlist) ||
                                        n.default.active_index != i ||
                                        (s.default.pause(), a.default.sync())),
                                null != t &&
                                    null != e &&
                                    (function (e, t) {
                                        n.default.active_playlist == e &&
                                            n.default.playlists[e]
                                                .active_index == t &&
                                            (s.default.pause(),
                                            a.default.sync());
                                    })(t, e);
                        }
                        var i, r;
                    },
                };
                (t.default = o), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = l(i(0)),
                    s = (l(i(6)), l(i(1))),
                    a = l(i(5)),
                    r = l(i(3)),
                    o = l(i(2));
                function l(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var u = {
                    handle: function () {
                        if (!n.default.is_touch_moving) {
                            var e = this.getAttribute(
                                    "data-amplitude-song-index"
                                ),
                                t = this.getAttribute(
                                    "data-amplitude-playlist"
                                );
                            null == t &&
                                null == e &&
                                (s.default.play(), o.default.sync()),
                                null != t &&
                                    null == e &&
                                    ((l = t),
                                    a.default.newPlaylist(l) &&
                                        (r.default.setActivePlaylist(l),
                                        n.default.playlists[l].shuffle
                                            ? r.default.changeSongPlaylist(
                                                  l,
                                                  n.default.playlists[l]
                                                      .shuffle_list[0],
                                                  0
                                              )
                                            : r.default.changeSongPlaylist(
                                                  l,
                                                  n.default.playlists[l]
                                                      .songs[0],
                                                  0
                                              )),
                                    s.default.play(),
                                    o.default.sync()),
                                null == t &&
                                    null != e &&
                                    ((i = e),
                                    a.default.newPlaylist(null) &&
                                        (r.default.setActivePlaylist(null),
                                        r.default.changeSong(
                                            n.default.songs[i],
                                            i
                                        )),
                                    a.default.newSong(null, i) &&
                                        r.default.changeSong(
                                            n.default.songs[i],
                                            i
                                        ),
                                    s.default.play(),
                                    o.default.sync()),
                                null != t &&
                                    null != e &&
                                    (function (e, t) {
                                        a.default.newPlaylist(e) &&
                                            (r.default.setActivePlaylist(e),
                                            r.default.changeSongPlaylist(
                                                e,
                                                n.default.playlists[e].songs[t],
                                                t
                                            )),
                                            a.default.newSong(e, t) &&
                                                r.default.changeSongPlaylist(
                                                    e,
                                                    n.default.playlists[e]
                                                        .songs[t],
                                                    t
                                                ),
                                            s.default.play(),
                                            o.default.sync();
                                    })(t, e);
                        }
                        var i, l;
                    },
                };
                (t.default = u), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = l(i(0)),
                    s = (l(i(6)), l(i(1))),
                    a = l(i(5)),
                    r = l(i(3)),
                    o = l(i(2));
                function l(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var u = {
                    handle: function () {
                        if (!n.default.is_touch_moving) {
                            var e = this.getAttribute(
                                    "data-amplitude-playlist"
                                ),
                                t = this.getAttribute(
                                    "data-amplitude-song-index"
                                );
                            null == e &&
                                null == t &&
                                (n.default.audio.paused
                                    ? s.default.play()
                                    : s.default.pause(),
                                o.default.sync()),
                                null != e &&
                                    null == t &&
                                    (function (e) {
                                        a.default.newPlaylist(e) &&
                                            (r.default.setActivePlaylist(e),
                                            n.default.playlists[e].shuffle
                                                ? r.default.changeSongPlaylist(
                                                      e,
                                                      n.default.playlists[e]
                                                          .shuffle_list[0],
                                                      0,
                                                      !0
                                                  )
                                                : r.default.changeSongPlaylist(
                                                      e,
                                                      n.default.playlists[e]
                                                          .songs[0],
                                                      0
                                                  )),
                                            n.default.audio.paused
                                                ? s.default.play()
                                                : s.default.pause(),
                                            o.default.sync();
                                    })(e),
                                null == e &&
                                    null != t &&
                                    (function (e) {
                                        a.default.newPlaylist(null) &&
                                            (r.default.setActivePlaylist(null),
                                            r.default.changeSong(
                                                n.default.songs[e],
                                                e,
                                                !0
                                            )),
                                            a.default.newSong(null, e) &&
                                                r.default.changeSong(
                                                    n.default.songs[e],
                                                    e,
                                                    !0
                                                ),
                                            n.default.audio.paused
                                                ? s.default.play()
                                                : s.default.pause(),
                                            o.default.sync();
                                    })(t),
                                null != e &&
                                    null != t &&
                                    (function (e, t) {
                                        a.default.newPlaylist(e) &&
                                            (r.default.setActivePlaylist(e),
                                            r.default.changeSongPlaylist(
                                                e,
                                                n.default.playlists[e].songs[t],
                                                t,
                                                !0
                                            )),
                                            a.default.newSong(e, t) &&
                                                r.default.changeSongPlaylist(
                                                    e,
                                                    n.default.playlists[e]
                                                        .songs[t],
                                                    t,
                                                    !0
                                                ),
                                            n.default.audio.paused
                                                ? s.default.play()
                                                : s.default.pause(),
                                            o.default.sync();
                                    })(e, t);
                        }
                    },
                };
                (t.default = u), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = r(i(0)),
                    s = r(i(1)),
                    a = r(i(18));
                function r(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var o = {
                    handle: function () {
                        if (!n.default.is_touch_moving) {
                            switch (n.default.playback_speed) {
                                case 1:
                                    s.default.setPlaybackSpeed(1.5);
                                    break;
                                case 1.5:
                                    s.default.setPlaybackSpeed(2);
                                    break;
                                case 2:
                                    s.default.setPlaybackSpeed(1);
                            }
                            a.default.sync();
                        }
                    },
                };
                (t.default = o), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = r(i(0)),
                    s = r(i(3)),
                    a = r(i(4));
                function r(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var o = {
                    handle: function () {
                        if (!n.default.is_touch_moving) {
                            var e = this.getAttribute(
                                "data-amplitude-playlist"
                            );
                            null == e &&
                                ("" == n.default.active_playlist ||
                                null == n.default.active_playlist
                                    ? s.default.setPrevious()
                                    : s.default.setPreviousPlaylist(
                                          n.default.active_playlist
                                      )),
                                null != e &&
                                    (function (e) {
                                        e == n.default.active_playlist
                                            ? s.default.setPreviousPlaylist(
                                                  n.default.active_playlist
                                              )
                                            : a.default.writeMessage(
                                                  "You can not go to the previous song on a playlist that is not being played!"
                                              );
                                    })(e);
                        }
                    },
                };
                (t.default = o), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = a(i(0)),
                    s = a(i(24));
                function a(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var r = {
                    handle: function () {
                        if (n.default.audio.buffered.length - 1 >= 0) {
                            var e = n.default.audio.buffered.end(
                                    n.default.audio.buffered.length - 1
                                ),
                                t = n.default.audio.duration;
                            n.default.buffered = (e / t) * 100;
                        }
                        s.default.sync();
                    },
                };
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = r(i(0)),
                    s = r(i(12)),
                    a = r(i(8));
                function r(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var o = {
                    handle: function () {
                        if (!n.default.is_touch_moving) {
                            var e = this.getAttribute(
                                "data-amplitude-playlist"
                            );
                            null == e &&
                                (s.default.setRepeat(!n.default.repeat),
                                a.default.syncRepeat()),
                                null != e &&
                                    (function (e) {
                                        s.default.setRepeatPlaylist(
                                            !n.default.playlists[e].repeat,
                                            e
                                        ),
                                            a.default.syncRepeatPlaylist(e);
                                    })(e);
                        }
                    },
                };
                (t.default = o), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = r(i(0)),
                    s = r(i(12)),
                    a = r(i(8));
                function r(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var o = {
                    handle: function () {
                        n.default.is_touch_moving ||
                            (s.default.setRepeatSong(!n.default.repeat_song),
                            a.default.syncRepeatSong());
                    },
                };
                (t.default = o), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = r(i(0)),
                    s = r(i(13)),
                    a = r(i(19));
                function r(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var o = {
                    handle: function () {
                        if (!n.default.is_touch_moving) {
                            var e = this.getAttribute(
                                "data-amplitude-playlist"
                            );
                            null == e
                                ? (s.default.toggleShuffle(),
                                  a.default.syncMain(n.default.shuffle_on))
                                : (function (e) {
                                      s.default.toggleShufflePlaylist(e),
                                          a.default.syncPlaylist(e);
                                  })(e);
                        }
                    },
                };
                (t.default = o), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = u(i(0)),
                    s = u(i(4)),
                    a = u(i(3)),
                    r = u(i(5)),
                    o = u(i(1)),
                    l = u(i(2));
                function u(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var d = {
                    handle: function () {
                        if (!n.default.is_touch_moving) {
                            var e = this.getAttribute(
                                    "data-amplitude-playlist"
                                ),
                                t = this.getAttribute(
                                    "data-amplitude-song-index"
                                ),
                                i = this.getAttribute(
                                    "data-amplitude-location"
                                );
                            null == i &&
                                s.default.writeMessage(
                                    "You must add an 'data-amplitude-location' attribute in seconds to your 'amplitude-skip-to' element."
                                ),
                                null == t &&
                                    s.default.writeMessage(
                                        "You must add an 'data-amplitude-song-index' attribute to your 'amplitude-skip-to' element."
                                    ),
                                null != i &&
                                    null != t &&
                                    (null == e
                                        ? (function (e, t) {
                                              a.default.changeSong(
                                                  n.default.songs[e],
                                                  e
                                              ),
                                                  o.default.play(),
                                                  l.default.syncGlobal(),
                                                  l.default.syncSong(),
                                                  o.default.skipToLocation(t);
                                          })(parseInt(t), parseInt(i))
                                        : (function (e, t, i) {
                                              r.default.newPlaylist(e) &&
                                                  a.default.setActivePlaylist(
                                                      e
                                                  ),
                                                  a.default.changeSongPlaylist(
                                                      e,
                                                      n.default.playlists[e]
                                                          .songs[t],
                                                      t
                                                  ),
                                                  o.default.play(),
                                                  l.default.syncGlobal(),
                                                  l.default.syncPlaylist(),
                                                  l.default.syncSong(),
                                                  o.default.skipToLocation(i);
                                          })(e, parseInt(t), parseInt(i)));
                        }
                    },
                };
                (t.default = d), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = r(i(0)),
                    s = r(i(23)),
                    a = r(i(14));
                function r(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var o = {
                    handle: function () {
                        var e = this.value,
                            t = n.default.audio.duration * (e / 100),
                            i = this.getAttribute("data-amplitude-playlist"),
                            r = this.getAttribute("data-amplitude-song-index");
                        null == i &&
                            null == r &&
                            (function (e, t) {
                                n.default.active_metadata.live ||
                                    (s.default.setCurrentTime(e),
                                    a.default.sync(
                                        t,
                                        n.default.active_playlist,
                                        n.default.active_index
                                    ));
                            })(t, e),
                            null != i &&
                                null == r &&
                                (function (e, t, i) {
                                    n.default.active_playlist == i &&
                                        (n.default.active_metadata.live ||
                                            (s.default.setCurrentTime(e),
                                            a.default.sync(
                                                t,
                                                i,
                                                n.default.active_index
                                            )));
                                })(t, e, i),
                            null == i &&
                                null != r &&
                                (function (e, t, i) {
                                    n.default.active_index == i &&
                                        null == n.default.active_playlist &&
                                        (n.default.active_metadata.live ||
                                            (s.default.setCurrentTime(e),
                                            a.default.sync(
                                                t,
                                                n.default.active_playlist,
                                                i
                                            )));
                                })(t, e, r),
                            null != i &&
                                null != r &&
                                (function (e, t, i, r) {
                                    n.default.playlists[i].active_index == r &&
                                        n.default.active_playlist == i &&
                                        (n.default.active_metadata.live ||
                                            (s.default.setCurrentTime(e),
                                            a.default.sync(t, i, r)));
                                })(t, e, i, r);
                    },
                };
                (t.default = o), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = r(i(0)),
                    s = (r(i(6)), r(i(2))),
                    a = r(i(1));
                function r(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var o = {
                    handle: function () {
                        n.default.is_touch_moving ||
                            (s.default.syncToPause(), a.default.stop());
                    },
                };
                (t.default = o), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = u(i(0)),
                    s = u(i(24)),
                    a = u(i(15)),
                    r = u(i(14)),
                    o = u(i(20)),
                    l = u(i(23));
                u(i(9));
                function u(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var d = {
                    handle: function () {
                        !(function () {
                            if (n.default.audio.buffered.length - 1 >= 0) {
                                var e = n.default.audio.buffered.end(
                                        n.default.audio.buffered.length - 1
                                    ),
                                    t = n.default.audio.duration;
                                n.default.buffered = (e / t) * 100;
                            }
                        })(),
                            s.default.sync(),
                            (function () {
                                if (!n.default.active_metadata.live) {
                                    var e = l.default.computeCurrentTimes(),
                                        t =
                                            l.default.computeSongCompletionPercentage(),
                                        i = l.default.computeSongDuration();
                                    a.default.syncCurrentTimes(e),
                                        r.default.sync(
                                            t,
                                            n.default.active_playlist,
                                            n.default.active_index
                                        ),
                                        o.default.sync(t),
                                        a.default.syncDurationTimes(e, i);
                                }
                            })(),
                            (function () {
                                var e = Math.floor(n.default.audio.currentTime);
                                if (
                                    null !=
                                        n.default.active_metadata
                                            .time_callbacks &&
                                    null !=
                                        n.default.active_metadata
                                            .time_callbacks[e]
                                )
                                    n.default.active_metadata.time_callbacks[e]
                                        .run ||
                                        ((n.default.active_metadata.time_callbacks[
                                            e
                                        ].run = !0),
                                        n.default.active_metadata.time_callbacks[
                                            e
                                        ]());
                                else
                                    for (var t in n.default.active_metadata
                                        .time_callbacks)
                                        n.default.active_metadata.time_callbacks.hasOwnProperty(
                                            t
                                        ) &&
                                            (n.default.active_metadata.time_callbacks[
                                                t
                                            ].run = !1);
                            })();
                    },
                };
                (t.default = d), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = o(i(0)),
                    s = o(i(1)),
                    a = o(i(10)),
                    r = o(i(11));
                function o(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var l = {
                    handle: function () {
                        if (!n.default.is_touch_moving) {
                            var e = null;
                            (e =
                                n.default.volume - n.default.volume_increment >
                                0
                                    ? n.default.volume -
                                      n.default.volume_increment
                                    : 0),
                                s.default.setVolume(e),
                                a.default.setMuted(0 == n.default.volume),
                                r.default.sync();
                        }
                    },
                };
                (t.default = l), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = o(i(0)),
                    s = o(i(1)),
                    a = o(i(10)),
                    r = o(i(11));
                function o(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var l = {
                    handle: function () {
                        s.default.setVolume(this.value),
                            a.default.setMuted(0 == n.default.volume),
                            r.default.sync();
                    },
                };
                (t.default = l), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = o(i(0)),
                    s = o(i(1)),
                    a = o(i(10)),
                    r = o(i(11));
                function o(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var l = {
                    handle: function () {
                        if (!n.default.is_touch_moving) {
                            var e = null;
                            (e =
                                n.default.volume + n.default.volume_increment <=
                                100
                                    ? n.default.volume +
                                      n.default.volume_increment
                                    : 100),
                                s.default.setVolume(e),
                                a.default.setMuted(0 == n.default.volume),
                                r.default.sync();
                        }
                    },
                };
                (t.default = l), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = {
                    configureWebAudioAPI: function () {
                        var e =
                            window.AudioContext ||
                            window.webkitAudioContext ||
                            window.mozAudioContext ||
                            window.oAudioContext ||
                            window.msAudioContext;
                        e
                            ? ((a.default.context = new e()),
                              (a.default.analyser =
                                  a.default.context.createAnalyser()),
                              (a.default.audio.crossOrigin = "anonymous"),
                              (a.default.source =
                                  a.default.context.createMediaElementSource(
                                      a.default.audio
                                  )),
                              a.default.source.connect(a.default.analyser),
                              a.default.analyser.connect(
                                  a.default.context.destination
                              ))
                            : AmplitudeHelpers.writeDebugMessage(
                                  "Web Audio API is unavailable! We will set any of your visualizations with your back up definition!"
                              );
                    },
                    webAudioAPIAvailable: function () {
                        var e =
                            window.AudioContext ||
                            window.webkitAudioContext ||
                            window.mozAudioContext ||
                            window.oAudioContext ||
                            window.msAudioContext;
                        return (
                            (a.default.web_audio_api_available = !1),
                            e
                                ? ((a.default.web_audio_api_available = !0), !0)
                                : ((a.default.web_audio_api_available = !1), !1)
                        );
                    },
                    determineUsingAnyFX: function () {
                        var e = document.querySelectorAll(
                                ".amplitude-wave-form"
                            ),
                            t = document.querySelectorAll(
                                ".amplitude-visualization"
                            );
                        return e.length > 0 || t.length > 0;
                    },
                };
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = x(i(21)),
                    s = x(i(0)),
                    a = x(i(1)),
                    r = x(i(13)),
                    o = (x(i(6)), x(i(3))),
                    l = x(i(12)),
                    u = x(i(5)),
                    d = x(i(16)),
                    c = x(i(19)),
                    h = x(i(8)),
                    f = x(i(14)),
                    p = x(i(20)),
                    m = x(i(15)),
                    g = x(i(2)),
                    v = x(i(7)),
                    y = x(i(18)),
                    b = x(i(4)),
                    _ = x(i(17));
                function x(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var w = {
                    init: function (e) {
                        n.default.initialize(e);
                    },
                    getConfig: function () {
                        return s.default;
                    },
                    bindNewElements: function () {
                        n.default.rebindDisplay();
                    },
                    getActivePlaylist: function () {
                        return s.default.active_playlist;
                    },
                    getPlaybackSpeed: function () {
                        return s.default.playback_speed;
                    },
                    setPlaybackSpeed: function (e) {
                        a.default.setPlaybackSpeed(e), y.default.sync();
                    },
                    getRepeat: function () {
                        return s.default.repeat;
                    },
                    getRepeatPlaylist: function (e) {
                        return s.default.playlists[e].repeat;
                    },
                    getShuffle: function () {
                        return s.default.shuffle_on;
                    },
                    getShufflePlaylist: function (e) {
                        return s.default.playlists[e].shuffle;
                    },
                    setShuffle: function (e) {
                        r.default.setShuffle(e), c.default.syncMain();
                    },
                    setShufflePlaylist: function (e, t) {
                        r.default.setShufflePlaylist(e, t),
                            c.default.syncMain(),
                            c.default.syncPlaylist(e);
                    },
                    setRepeat: function (e) {
                        l.default.setRepeat(e), h.default.syncRepeat();
                    },
                    setRepeatSong: function (e) {
                        s.default.is_touch_moving ||
                            (l.default.setRepeatSong(!s.default.repeat_song),
                            h.default.syncRepeatSong());
                    },
                    setRepeatPlaylist: function (e, t) {
                        l.default.setRepeatPlaylist(t, e),
                            h.default.syncRepeatPlaylist(e);
                    },
                    getDefaultAlbumArt: function () {
                        return s.default.default_album_art;
                    },
                    setDefaultAlbumArt: function (e) {
                        s.default.default_album_art = e;
                    },
                    getDefaultPlaylistArt: function () {
                        return s.default.default_playlist_art;
                    },
                    setDefaultPlaylistArt: function (e) {
                        s.default.default_plalist_art = e;
                    },
                    getSongPlayedPercentage: function () {
                        return (
                            (s.default.audio.currentTime /
                                s.default.audio.duration) *
                            100
                        );
                    },
                    setSongPlayedPercentage: function (e) {
                        "number" == typeof e &&
                            e > 0 &&
                            e < 100 &&
                            (s.default.audio.currentTime =
                                s.default.audio.duration * (e / 100));
                    },
                    getSongPlayedSeconds: function () {
                        return s.default.audio.currentTime;
                    },
                    getSongDuration: function () {
                        return s.default.audio.duration;
                    },
                    setDebug: function (e) {
                        s.default.debug = e;
                    },
                    getActiveSongMetadata: function () {
                        return s.default.active_metadata;
                    },
                    getActivePlaylistMetadata: function () {
                        return s.default.playlists[s.default.active_playlist];
                    },
                    getSongAtIndex: function (e) {
                        return s.default.songs[e];
                    },
                    getSongAtPlaylistIndex: function (e, t) {
                        return s.default.playlists[e].songs[t];
                    },
                    addSong: function (e) {
                        return (
                            null == s.default.songs && (s.default.songs = []),
                            s.default.songs.push(e),
                            s.default.shuffle_on &&
                                s.default.shuffle_list.push(e),
                            _.default.isSoundCloudURL(e.url) &&
                                _.default.resolveIndividualStreamableURL(
                                    e.url,
                                    null,
                                    s.default.songs.length - 1,
                                    s.default.shuffle_on
                                ),
                            s.default.songs.length - 1
                        );
                    },
                    prependSong: function (e) {
                        return (
                            null == s.default.songs && (s.default.songs = []),
                            s.default.songs.unshift(e),
                            s.default.shuffle_on &&
                                s.default.shuffle_list.unshift(e),
                            _.default.isSoundCloudURL(e.url) &&
                                _.default.resolveIndividualStreamableURL(
                                    e.url,
                                    null,
                                    s.default.songs.length - 1,
                                    s.default.shuffle_on
                                ),
                            0
                        );
                    },
                    addSongToPlaylist: function (e, t) {
                        return null != s.default.playlists[t]
                            ? (s.default.playlists[t].songs.push(e),
                              s.default.playlists[t].shuffle &&
                                  s.default.playlists[t].shuffle_list.push(e),
                              _.default.isSoundCloudURL(e.url) &&
                                  _.default.resolveIndividualStreamableURL(
                                      e.url,
                                      t,
                                      s.default.playlists[t].songs.length - 1,
                                      s.default.playlists[t].shuffle
                                  ),
                              s.default.playlists[t].songs.length - 1)
                            : (b.default.writeMessage(
                                  "Playlist doesn't exist!"
                              ),
                              null);
                    },
                    removeSong: function (e) {
                        s.default.songs.splice(e, 1);
                    },
                    removeSongFromPlaylist: function (e, t) {
                        null != s.default.playlists[t] &&
                            s.default.playlists[t].songs.splice(e, 1);
                    },
                    playNow: function (e) {
                        e.url
                            ? ((s.default.audio.src = e.url),
                              (s.default.active_metadata = e),
                              (s.default.active_album = e.album))
                            : b.default.writeMessage(
                                  "The song needs to have a URL!"
                              ),
                            a.default.play(),
                            g.default.sync(),
                            v.default.displayMetaData(),
                            f.default.resetElements(),
                            p.default.resetElements(),
                            m.default.resetCurrentTimes(),
                            m.default.resetDurationTimes();
                    },
                    playSongAtIndex: function (e) {
                        a.default.stop(),
                            u.default.newPlaylist(null) &&
                                (o.default.setActivePlaylist(null),
                                o.default.changeSong(s.default.songs[e], e)),
                            u.default.newSong(null, e) &&
                                o.default.changeSong(s.default.songs[e], e),
                            a.default.play(),
                            g.default.sync();
                    },
                    playPlaylistSongAtIndex: function (e, t) {
                        a.default.stop(),
                            u.default.newPlaylist(t) &&
                                (o.default.setActivePlaylist(t),
                                o.default.changeSongPlaylist(
                                    t,
                                    s.default.playlists[t].songs[e],
                                    e
                                )),
                            u.default.newSong(t, e) &&
                                o.default.changeSongPlaylist(
                                    t,
                                    s.default.playlists[t].songs[e],
                                    e
                                ),
                            g.default.sync(),
                            a.default.play();
                    },
                    play: function () {
                        a.default.play();
                    },
                    pause: function () {
                        a.default.pause();
                    },
                    stop: function () {
                        a.default.stop();
                    },
                    getAudio: function () {
                        return s.default.audio;
                    },
                    getAnalyser: function () {
                        return s.default.analyser;
                    },
                    next: function () {
                        var e =
                            arguments.length > 0 && void 0 !== arguments[0]
                                ? arguments[0]
                                : null;
                        "" == e || null == e
                            ? null == s.default.active_playlist ||
                              "" == s.default.active_playlist
                                ? o.default.setNext()
                                : o.default.setNextPlaylist(
                                      s.default.active_playlist
                                  )
                            : o.default.setNextPlaylist(e);
                    },
                    prev: function () {
                        var e =
                            arguments.length > 0 && void 0 !== arguments[0]
                                ? arguments[0]
                                : null;
                        "" == e || null == e
                            ? null == s.default.active_playlist ||
                              "" == s.default.active_playlist
                                ? o.default.setPrevious()
                                : o.default.setPreviousPlaylist(
                                      s.default.active_playlist
                                  )
                            : o.default.setPreviousPlaylist(e);
                    },
                    getSongs: function () {
                        return s.default.songs;
                    },
                    getSongsInPlaylist: function (e) {
                        return s.default.playlists[e].songs;
                    },
                    getSongsState: function () {
                        return s.default.shuffle_on
                            ? s.default.shuffle_list
                            : s.default.songs;
                    },
                    getSongsStatePlaylist: function (e) {
                        return s.default.playlists[e].shuffle
                            ? s.default.playlists[e].shuffle_list
                            : s.default.playlists[e].songs;
                    },
                    getActiveIndex: function () {
                        return parseInt(s.default.active_index);
                    },
                    getVersion: function () {
                        return s.default.version;
                    },
                    getBuffered: function () {
                        return s.default.buffered;
                    },
                    skipTo: function (e, t) {
                        var i =
                            arguments.length > 2 && void 0 !== arguments[2]
                                ? arguments[2]
                                : null;
                        (e = parseInt(e)),
                            null != i
                                ? (u.default.newPlaylist(i) &&
                                      o.default.setActivePlaylist(i),
                                  o.default.changeSongPlaylist(
                                      i,
                                      s.default.playlists[i].songs[t],
                                      t
                                  ),
                                  a.default.play(),
                                  g.default.syncGlobal(),
                                  g.default.syncPlaylist(),
                                  g.default.syncSong(),
                                  a.default.skipToLocation(e))
                                : (o.default.changeSong(s.default.songs[t], t),
                                  a.default.play(),
                                  g.default.syncGlobal(),
                                  g.default.syncSong(),
                                  a.default.skipToLocation(e));
                    },
                    setSongMetaData: function (e, t) {
                        var i =
                            arguments.length > 2 && void 0 !== arguments[2]
                                ? arguments[2]
                                : null;
                        if (
                            "" != i &&
                            null != i &&
                            null != s.default.playlists[i]
                        )
                            for (var n in t)
                                t.hasOwnProperty(n) &&
                                    "url" != n &&
                                    "URL" != n &&
                                    "live" != n &&
                                    "LIVE" != n &&
                                    (s.default.playlists[i].songs[e][n] = t[n]);
                        else
                            for (var n in t)
                                t.hasOwnProperty(n) &&
                                    "url" != n &&
                                    "URL" != n &&
                                    "live" != n &&
                                    "LIVE" != n &&
                                    (s.default.songs[e][n] = t[n]);
                        v.default.displayMetaData(), v.default.syncMetaData();
                    },
                    setPlaylistMetaData: function (e, t) {
                        if (null != s.default.playlists[e]) {
                            var i = [
                                "repeat",
                                "shuffle",
                                "shuffle_list",
                                "songs",
                                "src",
                            ];
                            for (var n in t)
                                t.hasOwnProperty(n) &&
                                    i.indexOf(n) < 0 &&
                                    (s.default.playlists[e][n] = t[n]);
                            v.default.displayPlaylistMetaData();
                        } else
                            b.default.writeMessage(
                                "You must provide a valid playlist key!"
                            );
                    },
                    setDelay: function (e) {
                        s.default.delay = e;
                    },
                    getDelay: function () {
                        return s.default.delay;
                    },
                    getPlayerState: function () {
                        return s.default.player_state;
                    },
                    addPlaylist: function (e, t, i) {
                        if (null == s.default.playlists[e]) {
                            s.default.playlists[e] = {};
                            var n = [
                                "repeat",
                                "shuffle",
                                "shuffle_list",
                                "songs",
                                "src",
                            ];
                            for (var a in t)
                                n.indexOf(a) < 0 &&
                                    (s.default.playlists[e][a] = t[a]);
                            return (
                                (s.default.playlists[e].songs = i),
                                (s.default.playlists[e].active_index = null),
                                (s.default.playlists[e].repeat = !1),
                                (s.default.playlists[e].shuffle = !1),
                                (s.default.playlists[e].shuffle_list = []),
                                s.default.playlists[e]
                            );
                        }
                        return (
                            b.default.writeMessage(
                                "A playlist already exists with that key!"
                            ),
                            null
                        );
                    },
                    registerVisualization: function (e, t) {
                        d.default.register(e, t);
                    },
                    setPlaylistVisualization: function (e, t) {
                        null != s.default.playlists[e]
                            ? null != s.default.visualizations.available[t]
                                ? (s.default.playlists[e].visualization = t)
                                : b.default.writeMessage(
                                      "A visualization does not exist for the key provided."
                                  )
                            : b.default.writeMessage(
                                  "The playlist for the key provided does not exist"
                              );
                    },
                    setSongVisualization: function (e, t) {
                        s.default.songs[e]
                            ? null != s.default.visualizations.available[t]
                                ? (s.default.songs[e].visualization = t)
                                : b.default.writeMessage(
                                      "A visualization does not exist for the key provided."
                                  )
                            : b.default.writeMessage(
                                  "A song at that index is undefined"
                              );
                    },
                    setSongInPlaylistVisualization: function (e, t, i) {
                        null != s.default.playlists[e].songs[t]
                            ? null != s.default.visualizations.available[i]
                                ? (s.default.playlists[e].songs[
                                      t
                                  ].visualization = i)
                                : b.default.writeMessage(
                                      "A visualization does not exist for the key provided."
                                  )
                            : b.default.writeMessage(
                                  "The song in the playlist at that key is not defined"
                              );
                    },
                    setGlobalVisualization: function (e) {
                        null != s.default.visualizations.available[e]
                            ? (s.default.visualization = e)
                            : b.default.writeMessage(
                                  "A visualization does not exist for the key provided."
                              );
                    },
                    getVolume: function () {
                        return s.default.volume;
                    },
                    setVolume: function (e) {
                        a.default.setVolume(e);
                    },
                };
                (t.default = w), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n = l(i(0)),
                    s = l(i(4)),
                    a = l(i(5)),
                    r = l(i(7)),
                    o = l(i(17));
                function l(e) {
                    return e && e.__esModule ? e : { default: e };
                }
                var u = {
                    initialize: function (e) {
                        (n.default.playlists = e),
                            (function () {
                                for (var e in n.default.playlists)
                                    if (
                                        n.default.playlists.hasOwnProperty(e) &&
                                        n.default.playlists[e].songs
                                    )
                                        for (
                                            var t = 0;
                                            t <
                                            n.default.playlists[e].songs.length;
                                            t++
                                        )
                                            a.default.isInt(
                                                n.default.playlists[e].songs[t]
                                            ) &&
                                                ((n.default.playlists[e].songs[
                                                    t
                                                ] =
                                                    n.default.songs[
                                                        n.default.playlists[
                                                            e
                                                        ].songs[t]
                                                    ]),
                                                (n.default.playlists[e].songs[
                                                    t
                                                ].index = t)),
                                                a.default.isInt(
                                                    n.default.playlists[e]
                                                        .songs[t]
                                                ) &&
                                                    !n.default.songs[
                                                        n.default.playlists[e]
                                                            .songs[t]
                                                    ] &&
                                                    s.default.writeMessage(
                                                        "The song index: " +
                                                            n.default.playlists[
                                                                e
                                                            ].songs[t] +
                                                            " in playlist with key: " +
                                                            e +
                                                            " is not defined in your songs array!"
                                                    ),
                                                a.default.isInt(
                                                    n.default.playlists[e]
                                                        .songs[t]
                                                ) ||
                                                    (n.default.playlists[
                                                        e
                                                    ].songs[t].index = t);
                            })(),
                            (function () {
                                for (var e in n.default.playlists)
                                    if (n.default.playlists.hasOwnProperty(e))
                                        for (
                                            var t = 0;
                                            t <
                                            n.default.playlists[e].songs.length;
                                            t++
                                        )
                                            o.default.isSoundCloudURL(
                                                n.default.playlists[e].songs[t]
                                                    .url
                                            ) &&
                                                null ==
                                                    n.default.playlists[e]
                                                        .songs[t]
                                                        .soundcloud_data &&
                                                o.default.resolveIndividualStreamableURL(
                                                    n.default.playlists[e]
                                                        .songs[t].url,
                                                    e,
                                                    t
                                                );
                            })(),
                            (function () {
                                for (var e in n.default.playlists)
                                    n.default.playlists[e].active_index = null;
                            })(),
                            (function () {
                                for (var e in n.default.playlists)
                                    n.default.playlists[e].shuffle = !1;
                            })(),
                            (function () {
                                for (var e in n.default.playlists)
                                    n.default.playlists[e].repeat = !1;
                            })(),
                            (function () {
                                for (var e in n.default.playlists)
                                    n.default.playlists[e].shuffle_list = [];
                            })(),
                            (function () {
                                for (var e in n.default.playlists)
                                    r.default.setFirstSongInPlaylist(
                                        n.default.playlists[e].songs[0],
                                        e
                                    );
                            })();
                    },
                };
                (t.default = u), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = {
                    setActive: function (e) {
                        for (
                            var t = document.getElementsByClassName(
                                    "amplitude-song-container"
                                ),
                                i = 0;
                            i < t.length;
                            i++
                        )
                            t[i].classList.remove(
                                "amplitude-active-song-container"
                            );
                        if (
                            "" == a.default.active_playlist ||
                            null == a.default.active_playlist
                        ) {
                            var n = "";
                            if (
                                ((n = e
                                    ? a.default.active_index
                                    : a.default.shuffle_on
                                    ? a.default.shuffle_list[
                                          a.default.active_index
                                      ].index
                                    : a.default.active_index),
                                document.querySelectorAll(
                                    '.amplitude-song-container[data-amplitude-song-index="' +
                                        n +
                                        '"]'
                                ))
                            )
                                for (
                                    var s = document.querySelectorAll(
                                            '.amplitude-song-container[data-amplitude-song-index="' +
                                                n +
                                                '"]'
                                        ),
                                        r = 0;
                                    r < s.length;
                                    r++
                                )
                                    s[r].hasAttribute(
                                        "data-amplitude-playlist"
                                    ) ||
                                        s[r].classList.add(
                                            "amplitude-active-song-container"
                                        );
                        } else {
                            if (
                                (null != a.default.active_playlist &&
                                    "" != a.default.active_playlist) ||
                                e
                            )
                                var o =
                                    a.default.playlists[
                                        a.default.active_playlist
                                    ].active_index;
                            else
                                (o = ""),
                                    (o = a.default.playlists[
                                        a.default.active_playlist
                                    ].shuffle
                                        ? a.default.playlists[
                                              a.default.active_playlist
                                          ].shuffle_list[
                                              a.default.playlists[
                                                  a.default.active_playlist
                                              ].active_index
                                          ].index
                                        : a.default.playlists[
                                              a.default.active_playlist
                                          ].active_index);
                            if (
                                document.querySelectorAll(
                                    '.amplitude-song-container[data-amplitude-song-index="' +
                                        o +
                                        '"][data-amplitude-playlist="' +
                                        a.default.active_playlist +
                                        '"]'
                                )
                            )
                                for (
                                    var l = document.querySelectorAll(
                                            '.amplitude-song-container[data-amplitude-song-index="' +
                                                o +
                                                '"][data-amplitude-playlist="' +
                                                a.default.active_playlist +
                                                '"]'
                                        ),
                                        u = 0;
                                    u < l.length;
                                    u++
                                )
                                    l[u].classList.add(
                                        "amplitude-active-song-container"
                                    );
                        }
                    },
                };
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = {
                    sync: function (e) {
                        !(function (e) {
                            for (
                                var t = document.querySelectorAll(
                                        ".amplitude-current-hours"
                                    ),
                                    i = 0;
                                i < t.length;
                                i++
                            ) {
                                var n = t[i].getAttribute(
                                        "data-amplitude-playlist"
                                    ),
                                    s = t[i].getAttribute(
                                        "data-amplitude-song-index"
                                    );
                                null == n && null == s && (t[i].innerHTML = e);
                            }
                        })(e),
                            (function (e) {
                                for (
                                    var t = document.querySelectorAll(
                                            '.amplitude-current-hours[data-amplitude-playlist="' +
                                                a.default.active_playlist +
                                                '"]'
                                        ),
                                        i = 0;
                                    i < t.length;
                                    i++
                                )
                                    null ==
                                        t[i].getAttribute(
                                            "data-amplitude-song-index"
                                        ) && (t[i].innerHTML = e);
                            })(e),
                            (function (e) {
                                if (null == a.default.active_playlist)
                                    for (
                                        var t = document.querySelectorAll(
                                                '.amplitude-current-hours[data-amplitude-song-index="' +
                                                    a.default.active_index +
                                                    '"]'
                                            ),
                                            i = 0;
                                        i < t.length;
                                        i++
                                    )
                                        null ==
                                            t[i].getAttribute(
                                                "data-amplitude-playlist"
                                            ) && (t[i].innerHTML = e);
                            })(e),
                            (function (e) {
                                for (
                                    var t =
                                            "" != a.default.active_playlist &&
                                            null != a.default.active_playlist
                                                ? a.default.playlists[
                                                      a.default.active_playlist
                                                  ].active_index
                                                : null,
                                        i = document.querySelectorAll(
                                            '.amplitude-current-hours[data-amplitude-playlist="' +
                                                a.default.active_playlist +
                                                '"][data-amplitude-song-index="' +
                                                t +
                                                '"]'
                                        ),
                                        n = 0;
                                    n < i.length;
                                    n++
                                )
                                    i[n].innerHTML = e;
                            })(e);
                    },
                    resetTimes: function () {
                        for (
                            var e = document.querySelectorAll(
                                    ".amplitude-current-hours"
                                ),
                                t = 0;
                            t < e.length;
                            t++
                        )
                            e[t].innerHTML = "00";
                    },
                };
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = {
                    sync: function (e) {
                        !(function (e) {
                            for (
                                var t = document.querySelectorAll(
                                        ".amplitude-current-minutes"
                                    ),
                                    i = 0;
                                i < t.length;
                                i++
                            ) {
                                var n = t[i].getAttribute(
                                        "data-amplitude-playlist"
                                    ),
                                    s = t[i].getAttribute(
                                        "data-amplitude-song-index"
                                    );
                                null == n && null == s && (t[i].innerHTML = e);
                            }
                        })(e),
                            (function (e) {
                                for (
                                    var t = document.querySelectorAll(
                                            '.amplitude-current-minutes[data-amplitude-playlist="' +
                                                a.default.active_playlist +
                                                '"]'
                                        ),
                                        i = 0;
                                    i < t.length;
                                    i++
                                )
                                    null ==
                                        t[i].getAttribute(
                                            "data-amplitude-song-index"
                                        ) && (t[i].innerHTML = e);
                            })(e),
                            (function (e) {
                                if (null == a.default.active_playlist)
                                    for (
                                        var t = document.querySelectorAll(
                                                '.amplitude-current-minutes[data-amplitude-song-index="' +
                                                    a.default.active_index +
                                                    '"]'
                                            ),
                                            i = 0;
                                        i < t.length;
                                        i++
                                    )
                                        null ==
                                            t[i].getAttribute(
                                                "data-amplitude-playlist"
                                            ) && (t[i].innerHTML = e);
                            })(e),
                            (function (e) {
                                for (
                                    var t =
                                            "" != a.default.active_playlist &&
                                            null != a.default.active_playlist
                                                ? a.default.playlists[
                                                      a.default.active_playlist
                                                  ].active_index
                                                : null,
                                        i = document.querySelectorAll(
                                            '.amplitude-current-minutes[data-amplitude-playlist="' +
                                                a.default.active_playlist +
                                                '"][data-amplitude-song-index="' +
                                                t +
                                                '"]'
                                        ),
                                        n = 0;
                                    n < i.length;
                                    n++
                                )
                                    i[n].innerHTML = e;
                            })(e);
                    },
                    resetTimes: function () {
                        for (
                            var e = document.querySelectorAll(
                                    ".amplitude-current-minutes"
                                ),
                                t = 0;
                            t < e.length;
                            t++
                        )
                            e[t].innerHTML = "00";
                    },
                };
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = {
                    sync: function (e) {
                        !(function (e) {
                            for (
                                var t = document.querySelectorAll(
                                        ".amplitude-current-seconds"
                                    ),
                                    i = 0;
                                i < t.length;
                                i++
                            ) {
                                var n = t[i].getAttribute(
                                        "data-amplitude-playlist"
                                    ),
                                    s = t[i].getAttribute(
                                        "data-amplitude-song-index"
                                    );
                                null == n && null == s && (t[i].innerHTML = e);
                            }
                        })(e),
                            (function (e) {
                                for (
                                    var t = document.querySelectorAll(
                                            '.amplitude-current-seconds[data-amplitude-playlist="' +
                                                a.default.active_playlist +
                                                '"]'
                                        ),
                                        i = 0;
                                    i < t.length;
                                    i++
                                )
                                    null ==
                                        t[i].getAttribute(
                                            "data-amplitude-song-index"
                                        ) && (t[i].innerHTML = e);
                            })(e),
                            (function (e) {
                                if (null == a.default.active_playlist)
                                    for (
                                        var t = document.querySelectorAll(
                                                '.amplitude-current-seconds[data-amplitude-song-index="' +
                                                    a.default.active_index +
                                                    '"]'
                                            ),
                                            i = 0;
                                        i < t.length;
                                        i++
                                    )
                                        null ==
                                            t[i].getAttribute(
                                                "data-amplitude-playlist"
                                            ) && (t[i].innerHTML = e);
                            })(e),
                            (function (e) {
                                for (
                                    var t =
                                            "" != a.default.active_playlist &&
                                            null != a.default.active_playlist
                                                ? a.default.playlists[
                                                      a.default.active_playlist
                                                  ].active_index
                                                : null,
                                        i = document.querySelectorAll(
                                            '.amplitude-current-seconds[data-amplitude-playlist="' +
                                                a.default.active_playlist +
                                                '"][data-amplitude-song-index="' +
                                                t +
                                                '"]'
                                        ),
                                        n = 0;
                                    n < i.length;
                                    n++
                                )
                                    i[n].innerHTML = e;
                            })(e);
                    },
                    resetTimes: function () {
                        for (
                            var e = document.querySelectorAll(
                                    ".amplitude-current-seconds"
                                ),
                                t = 0;
                            t < e.length;
                            t++
                        )
                            e[t].innerHTML = "00";
                    },
                };
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = {
                    sync: function (e) {
                        !(function (e) {
                            var t = document.querySelectorAll(
                                    ".amplitude-current-time"
                                ),
                                i = e.minutes + ":" + e.seconds;
                            e.hours > 0 && (i = e.hours + ":" + i);
                            for (var n = 0; n < t.length; n++) {
                                var s = t[n].getAttribute(
                                        "data-amplitude-playlist"
                                    ),
                                    a = t[n].getAttribute(
                                        "data-amplitude-song-index"
                                    );
                                null == s && null == a && (t[n].innerHTML = i);
                            }
                        })(e),
                            (function (e) {
                                var t = document.querySelectorAll(
                                        '.amplitude-current-time[data-amplitude-playlist="' +
                                            a.default.active_playlist +
                                            '"]'
                                    ),
                                    i = e.minutes + ":" + e.seconds;
                                e.hours > 0 && (i = e.hours + ":" + i);
                                for (var n = 0; n < t.length; n++)
                                    null ==
                                        t[n].getAttribute(
                                            "data-amplitude-song-index"
                                        ) && (t[n].innerHTML = i);
                            })(e),
                            (function (e) {
                                if (null == a.default.active_playlist) {
                                    var t = document.querySelectorAll(
                                            '.amplitude-current-time[data-amplitude-song-index="' +
                                                a.default.active_index +
                                                '"]'
                                        ),
                                        i = e.minutes + ":" + e.seconds;
                                    e.hours > 0 && (i = e.hours + ":" + i);
                                    for (var n = 0; n < t.length; n++)
                                        null ==
                                            t[n].getAttribute(
                                                "data-amplitude-playlist"
                                            ) && (t[n].innerHTML = i);
                                }
                            })(e),
                            (function (e) {
                                var t =
                                        "" != a.default.active_playlist &&
                                        null != a.default.active_playlist
                                            ? a.default.playlists[
                                                  a.default.active_playlist
                                              ].active_index
                                            : null,
                                    i = document.querySelectorAll(
                                        '.amplitude-current-time[data-amplitude-playlist="' +
                                            a.default.active_playlist +
                                            '"][data-amplitude-song-index="' +
                                            t +
                                            '"]'
                                    ),
                                    n = e.minutes + ":" + e.seconds;
                                e.hours > 0 && (n = e.hours + ":" + n);
                                for (var s = 0; s < i.length; s++)
                                    i[s].innerHTML = n;
                            })(e);
                    },
                    resetTimes: function () {
                        for (
                            var e = document.querySelectorAll(
                                    ".amplitude-current-time"
                                ),
                                t = 0;
                            t < e.length;
                            t++
                        )
                            e[t].innerHTML = "00:00";
                    },
                };
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = {
                    sync: function (e, t) {
                        var i = (function (e, t) {
                            var i = "00:00",
                                n =
                                    parseInt(e.seconds) +
                                    60 * parseInt(e.minutes) +
                                    60 * parseInt(e.hours) * 60,
                                s =
                                    parseInt(t.seconds) +
                                    60 * parseInt(t.minutes) +
                                    60 * parseInt(t.hours) * 60;
                            if (!isNaN(n) && !isNaN(s)) {
                                var a = s - n,
                                    r = Math.floor(a / 3600),
                                    o = Math.floor((a - 3600 * r) / 60),
                                    l = a - 3600 * r - 60 * o;
                                (i =
                                    (o < 10 ? "0" + o : o) +
                                    ":" +
                                    (l < 10 ? "0" + l : l)),
                                    r > 0 && (i = r + ":" + i);
                            }
                            return i;
                        })(e, t);
                        !(function (e) {
                            for (
                                var t = document.querySelectorAll(
                                        ".amplitude-time-remaining"
                                    ),
                                    i = 0;
                                i < t.length;
                                i++
                            ) {
                                var n = t[i].getAttribute(
                                        "data-amplitude-playlist"
                                    ),
                                    s = t[i].getAttribute(
                                        "data-amplitude-song-index"
                                    );
                                null == n && null == s && (t[i].innerHTML = e);
                            }
                        })(i),
                            (function (e) {
                                for (
                                    var t = document.querySelectorAll(
                                            '.amplitude-time-remaining[data-amplitude-playlist="' +
                                                a.default.active_playlist +
                                                '"]'
                                        ),
                                        i = 0;
                                    i < t.length;
                                    i++
                                )
                                    null ==
                                        t[i].getAttribute(
                                            "data-amplitude-song-index"
                                        ) && (t[i].innerHTML = e);
                            })(i),
                            (function (e) {
                                if (null == a.default.active_playlist)
                                    for (
                                        var t = document.querySelectorAll(
                                                '.amplitude-time-remaining[data-amplitude-song-index="' +
                                                    a.default.active_index +
                                                    '"]'
                                            ),
                                            i = 0;
                                        i < t.length;
                                        i++
                                    )
                                        null ==
                                            t[i].getAttribute(
                                                "data-amplitude-playlist"
                                            ) && (t[i].innerHTML = e);
                            })(i),
                            (function (e) {
                                for (
                                    var t =
                                            "" != a.default.active_playlist &&
                                            null != a.default.active_playlist
                                                ? a.default.playlists[
                                                      a.default.active_playlist
                                                  ].active_index
                                                : null,
                                        i = document.querySelectorAll(
                                            '.amplitude-time-remaining[data-amplitude-playlist="' +
                                                a.default.active_playlist +
                                                '"][data-amplitude-song-index="' +
                                                t +
                                                '"]'
                                        ),
                                        n = 0;
                                    n < i.length;
                                    n++
                                )
                                    i[n].innerHTML = e;
                            })(i);
                    },
                    resetTimes: function () {
                        for (
                            var e = document.querySelectorAll(
                                    ".amplitude-time-remaining"
                                ),
                                t = 0;
                            t < e.length;
                            t++
                        )
                            e[t].innerHTML = "00";
                    },
                };
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = {
                    sync: function (e) {
                        !(function (e) {
                            for (
                                var t = document.querySelectorAll(
                                        ".amplitude-duration-hours"
                                    ),
                                    i = 0;
                                i < t.length;
                                i++
                            ) {
                                var n = t[i].getAttribute(
                                        "data-amplitude-playlist"
                                    ),
                                    s = t[i].getAttribute(
                                        "data-amplitude-song-index"
                                    );
                                null == n && null == s && (t[i].innerHTML = e);
                            }
                        })(e),
                            (function (e) {
                                for (
                                    var t = document.querySelectorAll(
                                            '.amplitude-duration-hours[data-amplitude-playlist="' +
                                                a.default.active_playlist +
                                                '"]'
                                        ),
                                        i = 0;
                                    i < t.length;
                                    i++
                                )
                                    null ==
                                        t[i].getAttribute(
                                            "data-amplitude-song-index"
                                        ) && (t[i].innerHTML = e);
                            })(e),
                            (function (e) {
                                if (null == a.default.active_playlist)
                                    for (
                                        var t = document.querySelectorAll(
                                                '.amplitude-duration-hours[data-amplitude-song-index="' +
                                                    a.default.active_index +
                                                    '"]'
                                            ),
                                            i = 0;
                                        i < t.length;
                                        i++
                                    )
                                        null ==
                                            t[i].getAttribute(
                                                "data-amplitude-playlist"
                                            ) && (t[i].innerHTML = e);
                            })(e),
                            (function (e) {
                                for (
                                    var t =
                                            "" != a.default.active_playlist &&
                                            null != a.default.active_playlist
                                                ? a.default.playlists[
                                                      a.default.active_playlist
                                                  ].active_index
                                                : null,
                                        i = document.querySelectorAll(
                                            '.amplitude-duration-hours[data-amplitude-playlist="' +
                                                a.default.active_playlist +
                                                '"][data-amplitude-song-index="' +
                                                t +
                                                '"]'
                                        ),
                                        n = 0;
                                    n < i.length;
                                    n++
                                )
                                    i[n].innerHTML = e;
                            })(e);
                    },
                    resetTimes: function () {
                        for (
                            var e = document.querySelectorAll(
                                    ".amplitude-duration-hours"
                                ),
                                t = 0;
                            t < e.length;
                            t++
                        )
                            e[t].innerHTML = "00";
                    },
                };
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = {
                    sync: function (e) {
                        !(function (e) {
                            for (
                                var t = document.querySelectorAll(
                                        ".amplitude-duration-minutes"
                                    ),
                                    i = 0;
                                i < t.length;
                                i++
                            ) {
                                var n = t[i].getAttribute(
                                        "data-amplitude-playlist"
                                    ),
                                    s = t[i].getAttribute(
                                        "data-amplitude-song-index"
                                    );
                                null == n && null == s && (t[i].innerHTML = e);
                            }
                        })(e),
                            (function (e) {
                                for (
                                    var t = document.querySelectorAll(
                                            '.amplitude-duration-minutes[data-amplitude-playlist="' +
                                                a.default.active_playlist +
                                                '"]'
                                        ),
                                        i = 0;
                                    i < t.length;
                                    i++
                                )
                                    null ==
                                        t[i].getAttribute(
                                            "data-amplitude-song-index"
                                        ) && (t[i].innerHTML = e);
                            })(e),
                            (function (e) {
                                if (null == a.default.active_playlist)
                                    for (
                                        var t = document.querySelectorAll(
                                                '.amplitude-duration-minutes[data-amplitude-song-index="' +
                                                    a.default.active_index +
                                                    '"]'
                                            ),
                                            i = 0;
                                        i < t.length;
                                        i++
                                    )
                                        null ==
                                            t[i].getAttribute(
                                                "data-amplitude-playlist"
                                            ) && (t[i].innerHTML = e);
                            })(e),
                            (function (e) {
                                for (
                                    var t =
                                            "" != a.default.active_playlist &&
                                            null != a.default.active_playlist
                                                ? a.default.playlists[
                                                      a.default.active_playlist
                                                  ].active_index
                                                : null,
                                        i = document.querySelectorAll(
                                            '.amplitude-duration-minutes[data-amplitude-playlist="' +
                                                a.default.active_playlist +
                                                '"][data-amplitude-song-index="' +
                                                t +
                                                '"]'
                                        ),
                                        n = 0;
                                    n < i.length;
                                    n++
                                )
                                    i[n].innerHTML = e;
                            })(e);
                    },
                    resetTimes: function () {
                        for (
                            var e = document.querySelectorAll(
                                    ".amplitude-duration-minutes"
                                ),
                                t = 0;
                            t < e.length;
                            t++
                        )
                            e[t].innerHTML = "00";
                    },
                };
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = {
                    sync: function (e) {
                        !(function (e) {
                            for (
                                var t = document.querySelectorAll(
                                        ".amplitude-duration-seconds"
                                    ),
                                    i = 0;
                                i < t.length;
                                i++
                            ) {
                                var n = t[i].getAttribute(
                                        "data-amplitude-playlist"
                                    ),
                                    s = t[i].getAttribute(
                                        "data-amplitude-song-index"
                                    );
                                null == n && null == s && (t[i].innerHTML = e);
                            }
                        })(e),
                            (function (e) {
                                for (
                                    var t = document.querySelectorAll(
                                            '.amplitude-duration-seconds[data-amplitude-playlist="' +
                                                a.default.active_playlist +
                                                '"]'
                                        ),
                                        i = 0;
                                    i < t.length;
                                    i++
                                )
                                    null ==
                                        t[i].getAttribute(
                                            "data-amplitude-song-index"
                                        ) && (t[i].innerHTML = e);
                            })(e),
                            (function (e) {
                                if (null == a.default.active_playlist)
                                    for (
                                        var t = document.querySelectorAll(
                                                '.amplitude-duration-seconds[data-amplitude-song-index="' +
                                                    a.default.active_index +
                                                    '"]'
                                            ),
                                            i = 0;
                                        i < t.length;
                                        i++
                                    )
                                        null ==
                                            t[i].getAttribute(
                                                "data--amplitude-playlist"
                                            ) && (t[i].innerHTML = e);
                            })(e),
                            (function (e) {
                                for (
                                    var t =
                                            "" != a.default.active_playlist &&
                                            null != a.default.active_playlist
                                                ? a.default.playlists[
                                                      a.default.active_playlist
                                                  ].active_index
                                                : null,
                                        i = document.querySelectorAll(
                                            '.amplitude-duration-seconds[data-amplitude-playlist="' +
                                                a.default.active_playlist +
                                                '"][data-amplitude-song-index="' +
                                                t +
                                                '"]'
                                        ),
                                        n = 0;
                                    n < i.length;
                                    n++
                                )
                                    i[n].innerHTML = e;
                            })(e);
                    },
                    resetTimes: function () {
                        for (
                            var e = document.querySelectorAll(
                                    ".amplitude-duration-seconds"
                                ),
                                t = 0;
                            t < e.length;
                            t++
                        )
                            e[t].innerHTML = "00";
                    },
                };
                (t.default = r), (e.exports = t.default);
            },
            function (e, t, i) {
                "use strict";
                Object.defineProperty(t, "__esModule", { value: !0 });
                var n,
                    s = i(0),
                    a = (n = s) && n.__esModule ? n : { default: n };
                var r = {
                    sync: function (e) {
                        var t = (function (e) {
                            var t = "00:00";
                            return (
                                isNaN(e.minutes) ||
                                    isNaN(e.seconds) ||
                                    ((t = e.minutes + ":" + e.seconds),
                                    !isNaN(e.hours) &&
                                        e.hours > 0 &&
                                        (t = e.hours + ":" + t)),
                                t
                            );
                        })(e);
                        !(function (e) {
                            for (
                                var t = document.querySelectorAll(
                                        ".amplitude-duration-time"
                                    ),
                                    i = 0;
                                i < t.length;
                                i++
                            ) {
                                var n = t[i].getAttribute(
                                        "data-amplitude-playlist"
                                    ),
                                    s = t[i].getAttribute(
                                        "data-amplitude-song-index"
                                    );
                                null == n && null == s && (t[i].innerHTML = e);
                            }
                        })(t),
                            (function (e) {
                                for (
                                    var t = document.querySelectorAll(
                                            '.amplitude-duration-time[data-amplitude-playlist="' +
                                                a.default.active_playlist +
                                                '"]'
                                        ),
                                        i = 0;
                                    i < t.length;
                                    i++
                                )
                                    null ==
                                        t[i].getAttribute(
                                            "data-amplitude-song-index"
                                        ) && (t[i].innerHTML = e);
                            })(t),
                            (function (e) {
                                if (null == a.default.active_playlist)
                                    for (
                                        var t = document.querySelectorAll(
                                                '.amplitude-duration-time[data-amplitude-song-index="' +
                                                    a.default.active_index +
                                                    '"]'
                                            ),
                                            i = 0;
                                        i < t.length;
                                        i++
                                    )
                                        null ==
                                            t[i].getAttribute(
                                                "data-amplitude-playlist"
                                            ) && (t[i].innerHTML = e);
                            })(t),
                            (function (e) {
                                for (
                                    var t =
                                            "" != a.default.active_playlist &&
                                            null != a.default.active_playlist
                                                ? a.default.playlists[
                                                      a.default.active_playlist
                                                  ].active_index
                                                : null,
                                        i = document.querySelectorAll(
                                            '.amplitude-duration-time[data-amplitude-playlist="' +
                                                a.default.active_playlist +
                                                '"][data-amplitude-song-index="' +
                                                t +
                                                '"]'
                                        ),
                                        n = 0;
                                    n < i.length;
                                    n++
                                )
                                    i[n].innerHTML = e;
                            })(t);
                    },
                    resetTimes: function () {
                        for (
                            var e = document.querySelectorAll(
                                    ".amplitude-duration-time"
                                ),
                                t = 0;
                            t < e.length;
                            t++
                        )
                            e[t].innerHTML = "00:00";
                    },
                };
                (t.default = r), (e.exports = t.default);
            },
            function (e, t) {
                e.exports = {
                    name: "amplitudejs",
                    version: "5.3.2",
                    description:
                        "A JavaScript library that allows you to control the design of your media controls in your webpage -- not the browser. No dependencies (jQuery not required) https://521dimensions.com/open-source/amplitudejs",
                    main: "dist/amplitude.js",
                    devDependencies: {
                        "babel-core": "^6.26.3",
                        "babel-loader": "^7.1.5",
                        "babel-plugin-add-module-exports": "0.2.1",
                        "babel-polyfill": "^6.26.0",
                        "babel-preset-es2015": "^6.18.0",
                        husky: "^1.3.1",
                        jest: "^23.6.0",
                        prettier: "1.15.1",
                        "pretty-quick": "^1.11.1",
                        watch: "^1.0.2",
                        webpack: "^2.7.0",
                    },
                    directories: { doc: "docs" },
                    files: ["dist"],
                    funding: {
                        type: "opencollective",
                        url: "https://opencollective.com/amplitudejs",
                    },
                    scripts: {
                        build: "node_modules/.bin/webpack",
                        prettier: "npx pretty-quick",
                        preversion: "npx pretty-quick && npm run test",
                        postversion: "git push && git push --tags",
                        test: "jest",
                        version: "npm run build && git add -A dist",
                    },
                    repository: {
                        type: "git",
                        url: "git+https://github.com/521dimensions/amplitudejs.git",
                    },
                    keywords: [
                        "webaudio",
                        "html5",
                        "javascript",
                        "audio-player",
                    ],
                    author: "521 Dimensions (https://521dimensions.com)",
                    license: "MIT",
                    bugs: {
                        url: "https://github.com/521dimensions/amplitudejs/issues",
                    },
                    homepage:
                        "https://github.com/521dimensions/amplitudejs#readme",
                };
            },
        ]);
    }),
    (function (e, t) {
        "object" == typeof exports && "undefined" != typeof module
            ? (module.exports = t())
            : "function" == typeof define && define.amd
            ? define(t)
            : (e.moment = t());
    })(this, function () {
        "use strict";
        var e;
        function t() {
            return e.apply(null, arguments);
        }
        function i(e) {
            return (
                e instanceof Array ||
                "[object Array]" === Object.prototype.toString.call(e)
            );
        }
        function n(e) {
            return (
                null != e &&
                "[object Object]" === Object.prototype.toString.call(e)
            );
        }
        function s(e, t) {
            return Object.prototype.hasOwnProperty.call(e, t);
        }
        function a(e) {
            if (Object.getOwnPropertyNames)
                return 0 === Object.getOwnPropertyNames(e).length;
            for (var t in e) if (s(e, t)) return;
            return 1;
        }
        function r(e) {
            return void 0 === e;
        }
        function o(e) {
            return (
                "number" == typeof e ||
                "[object Number]" === Object.prototype.toString.call(e)
            );
        }
        function l(e) {
            return (
                e instanceof Date ||
                "[object Date]" === Object.prototype.toString.call(e)
            );
        }
        function u(e, t) {
            for (var i = [], n = e.length, s = 0; s < n; ++s)
                i.push(t(e[s], s));
            return i;
        }
        function d(e, t) {
            for (var i in t) s(t, i) && (e[i] = t[i]);
            return (
                s(t, "toString") && (e.toString = t.toString),
                s(t, "valueOf") && (e.valueOf = t.valueOf),
                e
            );
        }
        function c(e, t, i, n) {
            return vt(e, t, i, n, !0).utc();
        }
        function h(e) {
            return (
                null == e._pf &&
                    (e._pf = {
                        empty: !1,
                        unusedTokens: [],
                        unusedInput: [],
                        overflow: -2,
                        charsLeftOver: 0,
                        nullInput: !1,
                        invalidEra: null,
                        invalidMonth: null,
                        invalidFormat: !1,
                        userInvalidated: !1,
                        iso: !1,
                        parsedDateParts: [],
                        era: null,
                        meridiem: null,
                        rfc2822: !1,
                        weekdayMismatch: !1,
                    }),
                e._pf
            );
        }
        function f(e) {
            if (null == e._isValid) {
                var t = h(e),
                    i = m.call(t.parsedDateParts, function (e) {
                        return null != e;
                    });
                i =
                    !isNaN(e._d.getTime()) &&
                    t.overflow < 0 &&
                    !t.empty &&
                    !t.invalidEra &&
                    !t.invalidMonth &&
                    !t.invalidWeekday &&
                    !t.weekdayMismatch &&
                    !t.nullInput &&
                    !t.invalidFormat &&
                    !t.userInvalidated &&
                    (!t.meridiem || (t.meridiem && i));
                if (
                    (e._strict &&
                        (i =
                            i &&
                            0 === t.charsLeftOver &&
                            0 === t.unusedTokens.length &&
                            void 0 === t.bigHour),
                    null != Object.isFrozen && Object.isFrozen(e))
                )
                    return i;
                e._isValid = i;
            }
            return e._isValid;
        }
        function p(e) {
            var t = c(NaN);
            return null != e ? d(h(t), e) : (h(t).userInvalidated = !0), t;
        }
        var m =
                Array.prototype.some ||
                function (e) {
                    for (
                        var t = Object(this), i = t.length >>> 0, n = 0;
                        n < i;
                        n++
                    )
                        if (n in t && e.call(this, t[n], n, t)) return !0;
                    return !1;
                },
            g = (t.momentProperties = []),
            v = !1;
        function y(e, t) {
            var i,
                n,
                s,
                a = g.length;
            if (
                (r(t._isAMomentObject) ||
                    (e._isAMomentObject = t._isAMomentObject),
                r(t._i) || (e._i = t._i),
                r(t._f) || (e._f = t._f),
                r(t._l) || (e._l = t._l),
                r(t._strict) || (e._strict = t._strict),
                r(t._tzm) || (e._tzm = t._tzm),
                r(t._isUTC) || (e._isUTC = t._isUTC),
                r(t._offset) || (e._offset = t._offset),
                r(t._pf) || (e._pf = h(t)),
                r(t._locale) || (e._locale = t._locale),
                0 < a)
            )
                for (i = 0; i < a; i++) r((s = t[(n = g[i])])) || (e[n] = s);
            return e;
        }
        function b(e) {
            y(this, e),
                (this._d = new Date(null != e._d ? e._d.getTime() : NaN)),
                this.isValid() || (this._d = new Date(NaN)),
                !1 === v && ((v = !0), t.updateOffset(this), (v = !1));
        }
        function _(e) {
            return e instanceof b || (null != e && null != e._isAMomentObject);
        }
        function x(e) {
            !1 === t.suppressDeprecationWarnings &&
                "undefined" != typeof console &&
                console.warn &&
                console.warn("Deprecation warning: " + e);
        }
        function w(e, i) {
            var n = !0;
            return d(function () {
                if (
                    (null != t.deprecationHandler &&
                        t.deprecationHandler(null, e),
                    n)
                ) {
                    for (
                        var a, r, o = [], l = arguments.length, u = 0;
                        u < l;
                        u++
                    ) {
                        if (((a = ""), "object" == typeof arguments[u])) {
                            for (r in ((a += "\n[" + u + "] "), arguments[0]))
                                s(arguments[0], r) &&
                                    (a += r + ": " + arguments[0][r] + ", ");
                            a = a.slice(0, -2);
                        } else a = arguments[u];
                        o.push(a);
                    }
                    x(
                        e +
                            "\nArguments: " +
                            Array.prototype.slice.call(o).join("") +
                            "\n" +
                            new Error().stack
                    ),
                        (n = !1);
                }
                return i.apply(this, arguments);
            }, i);
        }
        var S = {};
        function M(e, i) {
            null != t.deprecationHandler && t.deprecationHandler(e, i),
                S[e] || (x(i), (S[e] = !0));
        }
        function E(e) {
            return (
                ("undefined" != typeof Function && e instanceof Function) ||
                "[object Function]" === Object.prototype.toString.call(e)
            );
        }
        function k(e, t) {
            var i,
                a = d({}, e);
            for (i in t)
                s(t, i) &&
                    (n(e[i]) && n(t[i])
                        ? ((a[i] = {}), d(a[i], e[i]), d(a[i], t[i]))
                        : null != t[i]
                        ? (a[i] = t[i])
                        : delete a[i]);
            for (i in e) s(e, i) && !s(t, i) && n(e[i]) && (a[i] = d({}, a[i]));
            return a;
        }
        function T(e) {
            null != e && this.set(e);
        }
        (t.suppressDeprecationWarnings = !1), (t.deprecationHandler = null);
        var C =
            Object.keys ||
            function (e) {
                var t,
                    i = [];
                for (t in e) s(e, t) && i.push(t);
                return i;
            };
        function A(e, t, i) {
            var n = "" + Math.abs(e);
            return (
                (0 <= e ? (i ? "+" : "") : "-") +
                Math.pow(10, Math.max(0, t - n.length))
                    .toString()
                    .substr(1) +
                n
            );
        }
        var P =
                /(\[[^\[]*\])|(\\)?([Hh]mm(ss)?|Mo|MM?M?M?|Do|DDDo|DD?D?D?|ddd?d?|do?|w[o|w]?|W[o|W]?|Qo?|N{1,5}|YYYYYY|YYYYY|YYYY|YY|y{2,4}|yo?|gg(ggg?)?|GG(GGG?)?|e|E|a|A|hh?|HH?|kk?|mm?|ss?|S{1,9}|x|X|zz?|ZZ?|.)/g,
            L = /(\[[^\[]*\])|(\\)?(LTS|LT|LL?L?L?|l{1,4})/g,
            D = {},
            O = {};
        function N(e, t, i, n) {
            var s =
                "string" == typeof n
                    ? function () {
                          return this[n]();
                      }
                    : n;
            e && (O[e] = s),
                t &&
                    (O[t[0]] = function () {
                        return A(s.apply(this, arguments), t[1], t[2]);
                    }),
                i &&
                    (O[i] = function () {
                        return this.localeData().ordinal(
                            s.apply(this, arguments),
                            e
                        );
                    });
        }
        function I(e, t) {
            return e.isValid()
                ? ((t = R(t, e.localeData())),
                  (D[t] =
                      D[t] ||
                      (function (e) {
                          for (
                              var t, i = e.match(P), n = 0, s = i.length;
                              n < s;
                              n++
                          )
                              O[i[n]]
                                  ? (i[n] = O[i[n]])
                                  : (i[n] = (t = i[n]).match(/\[[\s\S]/)
                                        ? t.replace(/^\[|\]$/g, "")
                                        : t.replace(/\\/g, ""));
                          return function (t) {
                              for (var n = "", a = 0; a < s; a++)
                                  n += E(i[a]) ? i[a].call(t, e) : i[a];
                              return n;
                          };
                      })(t)),
                  D[t](e))
                : e.localeData().invalidDate();
        }
        function R(e, t) {
            var i = 5;
            function n(e) {
                return t.longDateFormat(e) || e;
            }
            for (L.lastIndex = 0; 0 <= i && L.test(e); )
                (e = e.replace(L, n)), (L.lastIndex = 0), --i;
            return e;
        }
        var z = {};
        function $(e, t) {
            var i = e.toLowerCase();
            z[i] = z[i + "s"] = z[t] = e;
        }
        function F(e) {
            return "string" == typeof e ? z[e] || z[e.toLowerCase()] : void 0;
        }
        function H(e) {
            var t,
                i,
                n = {};
            for (i in e) s(e, i) && (t = F(i)) && (n[t] = e[i]);
            return n;
        }
        var j = {};
        function W(e, t) {
            j[e] = t;
        }
        function Y(e) {
            return (e % 4 == 0 && e % 100 != 0) || e % 400 == 0;
        }
        function B(e) {
            return e < 0 ? Math.ceil(e) || 0 : Math.floor(e);
        }
        function V(e) {
            var t = 0;
            return 0 != (e = +e) && isFinite(e) ? B(e) : t;
        }
        function q(e, i) {
            return function (n) {
                return null != n
                    ? (X(this, e, n), t.updateOffset(this, i), this)
                    : U(this, e);
            };
        }
        function U(e, t) {
            return e.isValid()
                ? e._d["get" + (e._isUTC ? "UTC" : "") + t]()
                : NaN;
        }
        function X(e, t, i) {
            e.isValid() &&
                !isNaN(i) &&
                ("FullYear" === t &&
                Y(e.year()) &&
                1 === e.month() &&
                29 === e.date()
                    ? ((i = V(i)),
                      e._d["set" + (e._isUTC ? "UTC" : "") + t](
                          i,
                          e.month(),
                          be(i, e.month())
                      ))
                    : e._d["set" + (e._isUTC ? "UTC" : "") + t](i));
        }
        var G = /\d/,
            K = /\d\d/,
            Q = /\d{3}/,
            Z = /\d{4}/,
            J = /[+-]?\d{6}/,
            ee = /\d\d?/,
            te = /\d\d\d\d?/,
            ie = /\d\d\d\d\d\d?/,
            ne = /\d{1,3}/,
            se = /\d{1,4}/,
            ae = /[+-]?\d{1,6}/,
            re = /\d+/,
            oe = /[+-]?\d+/,
            le = /Z|[+-]\d\d:?\d\d/gi,
            ue = /Z|[+-]\d\d(?::?\d\d)?/gi,
            de =
                /[0-9]{0,256}['a-z\u00A0-\u05FF\u0700-\uD7FF\uF900-\uFDCF\uFDF0-\uFF07\uFF10-\uFFEF]{1,256}|[\u0600-\u06FF\/]{1,256}(\s*?[\u0600-\u06FF]{1,256}){1,2}/i;
        function ce(e, t, i) {
            pe[e] = E(t)
                ? t
                : function (e, n) {
                      return e && i ? i : t;
                  };
        }
        function he(e, t) {
            return s(pe, e)
                ? pe[e](t._strict, t._locale)
                : new RegExp(
                      fe(
                          e
                              .replace("\\", "")
                              .replace(
                                  /\\(\[)|\\(\])|\[([^\]\[]*)\]|\\(.)/g,
                                  function (e, t, i, n, s) {
                                      return t || i || n || s;
                                  }
                              )
                      )
                  );
        }
        function fe(e) {
            return e.replace(/[-\/\\^$*+?.()|[\]{}]/g, "\\$&");
        }
        var pe = {},
            me = {};
        function ge(e, t) {
            var i,
                n,
                s = t;
            for (
                "string" == typeof e && (e = [e]),
                    o(t) &&
                        (s = function (e, i) {
                            i[t] = V(e);
                        }),
                    n = e.length,
                    i = 0;
                i < n;
                i++
            )
                me[e[i]] = s;
        }
        function ve(e, t) {
            ge(e, function (e, i, n, s) {
                (n._w = n._w || {}), t(e, n._w, n, s);
            });
        }
        var ye;
        function be(e, t) {
            if (isNaN(e) || isNaN(t)) return NaN;
            var i = ((t % (i = 12)) + i) % i;
            return (
                (e += (t - i) / 12),
                1 == i ? (Y(e) ? 29 : 28) : 31 - ((i % 7) % 2)
            );
        }
        (ye =
            Array.prototype.indexOf ||
            function (e) {
                for (var t = 0; t < this.length; ++t)
                    if (this[t] === e) return t;
                return -1;
            }),
            N("M", ["MM", 2], "Mo", function () {
                return this.month() + 1;
            }),
            N("MMM", 0, 0, function (e) {
                return this.localeData().monthsShort(this, e);
            }),
            N("MMMM", 0, 0, function (e) {
                return this.localeData().months(this, e);
            }),
            $("month", "M"),
            W("month", 8),
            ce("M", ee),
            ce("MM", ee, K),
            ce("MMM", function (e, t) {
                return t.monthsShortRegex(e);
            }),
            ce("MMMM", function (e, t) {
                return t.monthsRegex(e);
            }),
            ge(["M", "MM"], function (e, t) {
                t[1] = V(e) - 1;
            }),
            ge(["MMM", "MMMM"], function (e, t, i, n) {
                null != (n = i._locale.monthsParse(e, n, i._strict))
                    ? (t[1] = n)
                    : (h(i).invalidMonth = e);
            });
        var _e =
                "January_February_March_April_May_June_July_August_September_October_November_December".split(
                    "_"
                ),
            xe = "Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_"),
            we = /D[oD]?(\[[^\[\]]*\]|\s)+MMMM?/,
            Se = de,
            Me = de;
        function Ee(e, t) {
            var i;
            if (e.isValid()) {
                if ("string" == typeof t)
                    if (/^\d+$/.test(t)) t = V(t);
                    else if (!o((t = e.localeData().monthsParse(t)))) return;
                (i = Math.min(e.date(), be(e.year(), t))),
                    e._d["set" + (e._isUTC ? "UTC" : "") + "Month"](t, i);
            }
        }
        function ke(e) {
            return null != e
                ? (Ee(this, e), t.updateOffset(this, !0), this)
                : U(this, "Month");
        }
        function Te() {
            function e(e, t) {
                return t.length - e.length;
            }
            for (var t, i = [], n = [], s = [], a = 0; a < 12; a++)
                (t = c([2e3, a])),
                    i.push(this.monthsShort(t, "")),
                    n.push(this.months(t, "")),
                    s.push(this.months(t, "")),
                    s.push(this.monthsShort(t, ""));
            for (i.sort(e), n.sort(e), s.sort(e), a = 0; a < 12; a++)
                (i[a] = fe(i[a])), (n[a] = fe(n[a]));
            for (a = 0; a < 24; a++) s[a] = fe(s[a]);
            (this._monthsRegex = new RegExp("^(" + s.join("|") + ")", "i")),
                (this._monthsShortRegex = this._monthsRegex),
                (this._monthsStrictRegex = new RegExp(
                    "^(" + n.join("|") + ")",
                    "i"
                )),
                (this._monthsShortStrictRegex = new RegExp(
                    "^(" + i.join("|") + ")",
                    "i"
                ));
        }
        function Ce(e) {
            return Y(e) ? 366 : 365;
        }
        N("Y", 0, 0, function () {
            var e = this.year();
            return e <= 9999 ? A(e, 4) : "+" + e;
        }),
            N(0, ["YY", 2], 0, function () {
                return this.year() % 100;
            }),
            N(0, ["YYYY", 4], 0, "year"),
            N(0, ["YYYYY", 5], 0, "year"),
            N(0, ["YYYYYY", 6, !0], 0, "year"),
            $("year", "y"),
            W("year", 1),
            ce("Y", oe),
            ce("YY", ee, K),
            ce("YYYY", se, Z),
            ce("YYYYY", ae, J),
            ce("YYYYYY", ae, J),
            ge(["YYYYY", "YYYYYY"], 0),
            ge("YYYY", function (e, i) {
                i[0] = 2 === e.length ? t.parseTwoDigitYear(e) : V(e);
            }),
            ge("YY", function (e, i) {
                i[0] = t.parseTwoDigitYear(e);
            }),
            ge("Y", function (e, t) {
                t[0] = parseInt(e, 10);
            }),
            (t.parseTwoDigitYear = function (e) {
                return V(e) + (68 < V(e) ? 1900 : 2e3);
            });
        var Ae = q("FullYear", !0);
        function Pe(e, t, i, n, s, a, r) {
            var o;
            return (
                e < 100 && 0 <= e
                    ? ((o = new Date(e + 400, t, i, n, s, a, r)),
                      isFinite(o.getFullYear()) && o.setFullYear(e))
                    : (o = new Date(e, t, i, n, s, a, r)),
                o
            );
        }
        function Le(e) {
            var t;
            return (
                e < 100 && 0 <= e
                    ? (((t = Array.prototype.slice.call(arguments))[0] =
                          e + 400),
                      (t = new Date(Date.UTC.apply(null, t))),
                      isFinite(t.getUTCFullYear()) && t.setUTCFullYear(e))
                    : (t = new Date(Date.UTC.apply(null, arguments))),
                t
            );
        }
        function De(e, t, i) {
            return (
                (i = 7 + t - i) - ((7 + Le(e, 0, i).getUTCDay() - t) % 7) - 1
            );
        }
        function Oe(e, t, i, n, s) {
            var a;
            i =
                (t = 1 + 7 * (t - 1) + ((7 + i - n) % 7) + De(e, n, s)) <= 0
                    ? Ce((a = e - 1)) + t
                    : t > Ce(e)
                    ? ((a = e + 1), t - Ce(e))
                    : ((a = e), t);
            return { year: a, dayOfYear: i };
        }
        function Ne(e, t, i) {
            var n,
                s,
                a = De(e.year(), t, i);
            return (
                (a = Math.floor((e.dayOfYear() - a - 1) / 7) + 1) < 1
                    ? (n = a + Ie((s = e.year() - 1), t, i))
                    : a > Ie(e.year(), t, i)
                    ? ((n = a - Ie(e.year(), t, i)), (s = e.year() + 1))
                    : ((s = e.year()), (n = a)),
                { week: n, year: s }
            );
        }
        function Ie(e, t, i) {
            var n = De(e, t, i);
            t = De(e + 1, t, i);
            return (Ce(e) - n + t) / 7;
        }
        function Re(e, t) {
            return e.slice(t, 7).concat(e.slice(0, t));
        }
        N("w", ["ww", 2], "wo", "week"),
            N("W", ["WW", 2], "Wo", "isoWeek"),
            $("week", "w"),
            $("isoWeek", "W"),
            W("week", 5),
            W("isoWeek", 5),
            ce("w", ee),
            ce("ww", ee, K),
            ce("W", ee),
            ce("WW", ee, K),
            ve(["w", "ww", "W", "WW"], function (e, t, i, n) {
                t[n.substr(0, 1)] = V(e);
            }),
            N("d", 0, "do", "day"),
            N("dd", 0, 0, function (e) {
                return this.localeData().weekdaysMin(this, e);
            }),
            N("ddd", 0, 0, function (e) {
                return this.localeData().weekdaysShort(this, e);
            }),
            N("dddd", 0, 0, function (e) {
                return this.localeData().weekdays(this, e);
            }),
            N("e", 0, 0, "weekday"),
            N("E", 0, 0, "isoWeekday"),
            $("day", "d"),
            $("weekday", "e"),
            $("isoWeekday", "E"),
            W("day", 11),
            W("weekday", 11),
            W("isoWeekday", 11),
            ce("d", ee),
            ce("e", ee),
            ce("E", ee),
            ce("dd", function (e, t) {
                return t.weekdaysMinRegex(e);
            }),
            ce("ddd", function (e, t) {
                return t.weekdaysShortRegex(e);
            }),
            ce("dddd", function (e, t) {
                return t.weekdaysRegex(e);
            }),
            ve(["dd", "ddd", "dddd"], function (e, t, i, n) {
                null != (n = i._locale.weekdaysParse(e, n, i._strict))
                    ? (t.d = n)
                    : (h(i).invalidWeekday = e);
            }),
            ve(["d", "e", "E"], function (e, t, i, n) {
                t[n] = V(e);
            });
        var ze =
                "Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split(
                    "_"
                ),
            $e = "Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"),
            Fe = "Su_Mo_Tu_We_Th_Fr_Sa".split("_"),
            He = de,
            je = de,
            We = de;
        function Ye() {
            function e(e, t) {
                return t.length - e.length;
            }
            for (var t, i, n, s = [], a = [], r = [], o = [], l = 0; l < 7; l++)
                (n = c([2e3, 1]).day(l)),
                    (t = fe(this.weekdaysMin(n, ""))),
                    (i = fe(this.weekdaysShort(n, ""))),
                    (n = fe(this.weekdays(n, ""))),
                    s.push(t),
                    a.push(i),
                    r.push(n),
                    o.push(t),
                    o.push(i),
                    o.push(n);
            s.sort(e),
                a.sort(e),
                r.sort(e),
                o.sort(e),
                (this._weekdaysRegex = new RegExp(
                    "^(" + o.join("|") + ")",
                    "i"
                )),
                (this._weekdaysShortRegex = this._weekdaysRegex),
                (this._weekdaysMinRegex = this._weekdaysRegex),
                (this._weekdaysStrictRegex = new RegExp(
                    "^(" + r.join("|") + ")",
                    "i"
                )),
                (this._weekdaysShortStrictRegex = new RegExp(
                    "^(" + a.join("|") + ")",
                    "i"
                )),
                (this._weekdaysMinStrictRegex = new RegExp(
                    "^(" + s.join("|") + ")",
                    "i"
                ));
        }
        function Be() {
            return this.hours() % 12 || 12;
        }
        function Ve(e, t) {
            N(e, 0, 0, function () {
                return this.localeData().meridiem(
                    this.hours(),
                    this.minutes(),
                    t
                );
            });
        }
        function qe(e, t) {
            return t._meridiemParse;
        }
        N("H", ["HH", 2], 0, "hour"),
            N("h", ["hh", 2], 0, Be),
            N("k", ["kk", 2], 0, function () {
                return this.hours() || 24;
            }),
            N("hmm", 0, 0, function () {
                return "" + Be.apply(this) + A(this.minutes(), 2);
            }),
            N("hmmss", 0, 0, function () {
                return (
                    "" +
                    Be.apply(this) +
                    A(this.minutes(), 2) +
                    A(this.seconds(), 2)
                );
            }),
            N("Hmm", 0, 0, function () {
                return "" + this.hours() + A(this.minutes(), 2);
            }),
            N("Hmmss", 0, 0, function () {
                return (
                    "" +
                    this.hours() +
                    A(this.minutes(), 2) +
                    A(this.seconds(), 2)
                );
            }),
            Ve("a", !0),
            Ve("A", !1),
            $("hour", "h"),
            W("hour", 13),
            ce("a", qe),
            ce("A", qe),
            ce("H", ee),
            ce("h", ee),
            ce("k", ee),
            ce("HH", ee, K),
            ce("hh", ee, K),
            ce("kk", ee, K),
            ce("hmm", te),
            ce("hmmss", ie),
            ce("Hmm", te),
            ce("Hmmss", ie),
            ge(["H", "HH"], 3),
            ge(["k", "kk"], function (e, t, i) {
                (e = V(e)), (t[3] = 24 === e ? 0 : e);
            }),
            ge(["a", "A"], function (e, t, i) {
                (i._isPm = i._locale.isPM(e)), (i._meridiem = e);
            }),
            ge(["h", "hh"], function (e, t, i) {
                (t[3] = V(e)), (h(i).bigHour = !0);
            }),
            ge("hmm", function (e, t, i) {
                var n = e.length - 2;
                (t[3] = V(e.substr(0, n))),
                    (t[4] = V(e.substr(n))),
                    (h(i).bigHour = !0);
            }),
            ge("hmmss", function (e, t, i) {
                var n = e.length - 4,
                    s = e.length - 2;
                (t[3] = V(e.substr(0, n))),
                    (t[4] = V(e.substr(n, 2))),
                    (t[5] = V(e.substr(s))),
                    (h(i).bigHour = !0);
            }),
            ge("Hmm", function (e, t, i) {
                var n = e.length - 2;
                (t[3] = V(e.substr(0, n))), (t[4] = V(e.substr(n)));
            }),
            ge("Hmmss", function (e, t, i) {
                var n = e.length - 4,
                    s = e.length - 2;
                (t[3] = V(e.substr(0, n))),
                    (t[4] = V(e.substr(n, 2))),
                    (t[5] = V(e.substr(s)));
            }),
            (de = q("Hours", !0));
        var Ue,
            Xe = {
                calendar: {
                    sameDay: "[Today at] LT",
                    nextDay: "[Tomorrow at] LT",
                    nextWeek: "dddd [at] LT",
                    lastDay: "[Yesterday at] LT",
                    lastWeek: "[Last] dddd [at] LT",
                    sameElse: "L",
                },
                longDateFormat: {
                    LTS: "h:mm:ss A",
                    LT: "h:mm A",
                    L: "MM/DD/YYYY",
                    LL: "MMMM D, YYYY",
                    LLL: "MMMM D, YYYY h:mm A",
                    LLLL: "dddd, MMMM D, YYYY h:mm A",
                },
                invalidDate: "Invalid date",
                ordinal: "%d",
                dayOfMonthOrdinalParse: /\d{1,2}/,
                relativeTime: {
                    future: "in %s",
                    past: "%s ago",
                    s: "a few seconds",
                    ss: "%d seconds",
                    m: "a minute",
                    mm: "%d minutes",
                    h: "an hour",
                    hh: "%d hours",
                    d: "a day",
                    dd: "%d days",
                    w: "a week",
                    ww: "%d weeks",
                    M: "a month",
                    MM: "%d months",
                    y: "a year",
                    yy: "%d years",
                },
                months: _e,
                monthsShort: xe,
                week: { dow: 0, doy: 6 },
                weekdays: ze,
                weekdaysMin: Fe,
                weekdaysShort: $e,
                meridiemParse: /[ap]\.?m?\.?/i,
            },
            Ge = {},
            Ke = {};
        function Qe(e) {
            return e && e.toLowerCase().replace("_", "-");
        }
        function Ze(e) {
            var t;
            if (
                void 0 === Ge[e] &&
                "undefined" != typeof module &&
                module &&
                module.exports &&
                null != e.match("^[^/\\\\]*$")
            )
                try {
                    (t = Ue._abbr), require("./locale/" + e), Je(t);
                } catch (t) {
                    Ge[e] = null;
                }
            return Ge[e];
        }
        function Je(e, t) {
            return (
                e &&
                    ((t = r(t) ? tt(e) : et(e, t))
                        ? (Ue = t)
                        : "undefined" != typeof console &&
                          console.warn &&
                          console.warn(
                              "Locale " +
                                  e +
                                  " not found. Did you forget to load it?"
                          )),
                Ue._abbr
            );
        }
        function et(e, t) {
            if (null === t) return delete Ge[e], null;
            var i,
                n = Xe;
            if (((t.abbr = e), null != Ge[e]))
                M(
                    "defineLocaleOverride",
                    "use moment.updateLocale(localeName, config) to change an existing locale. moment.defineLocale(localeName, config) should only be used for creating a new locale See http://momentjs.com/guides/#/warnings/define-locale/ for more info."
                ),
                    (n = Ge[e]._config);
            else if (null != t.parentLocale)
                if (null != Ge[t.parentLocale]) n = Ge[t.parentLocale]._config;
                else {
                    if (null == (i = Ze(t.parentLocale)))
                        return (
                            Ke[t.parentLocale] || (Ke[t.parentLocale] = []),
                            Ke[t.parentLocale].push({ name: e, config: t }),
                            null
                        );
                    n = i._config;
                }
            return (
                (Ge[e] = new T(k(n, t))),
                Ke[e] &&
                    Ke[e].forEach(function (e) {
                        et(e.name, e.config);
                    }),
                Je(e),
                Ge[e]
            );
        }
        function tt(e) {
            var t;
            if (!(e = e && e._locale && e._locale._abbr ? e._locale._abbr : e))
                return Ue;
            if (!i(e)) {
                if ((t = Ze(e))) return t;
                e = [e];
            }
            return (function (e) {
                for (var t, i, n, s, a = 0; a < e.length; ) {
                    for (
                        t = (s = Qe(e[a]).split("-")).length,
                            i = (i = Qe(e[a + 1])) ? i.split("-") : null;
                        0 < t;

                    ) {
                        if ((n = Ze(s.slice(0, t).join("-")))) return n;
                        if (
                            i &&
                            i.length >= t &&
                            (function (e, t) {
                                for (
                                    var i = Math.min(e.length, t.length), n = 0;
                                    n < i;
                                    n += 1
                                )
                                    if (e[n] !== t[n]) return n;
                                return i;
                            })(s, i) >=
                                t - 1
                        )
                            break;
                        t--;
                    }
                    a++;
                }
                return Ue;
            })(e);
        }
        function it(e) {
            var t = e._a;
            return (
                t &&
                    -2 === h(e).overflow &&
                    ((t =
                        t[1] < 0 || 11 < t[1]
                            ? 1
                            : t[2] < 1 || t[2] > be(t[0], t[1])
                            ? 2
                            : t[3] < 0 ||
                              24 < t[3] ||
                              (24 === t[3] &&
                                  (0 !== t[4] || 0 !== t[5] || 0 !== t[6]))
                            ? 3
                            : t[4] < 0 || 59 < t[4]
                            ? 4
                            : t[5] < 0 || 59 < t[5]
                            ? 5
                            : t[6] < 0 || 999 < t[6]
                            ? 6
                            : -1),
                    h(e)._overflowDayOfYear && (t < 0 || 2 < t) && (t = 2),
                    h(e)._overflowWeeks && -1 === t && (t = 7),
                    h(e)._overflowWeekday && -1 === t && (t = 8),
                    (h(e).overflow = t)),
                e
            );
        }
        var nt =
                /^\s*((?:[+-]\d{6}|\d{4})-(?:\d\d-\d\d|W\d\d-\d|W\d\d|\d\d\d|\d\d))(?:(T| )(\d\d(?::\d\d(?::\d\d(?:[.,]\d+)?)?)?)([+-]\d\d(?::?\d\d)?|\s*Z)?)?$/,
            st =
                /^\s*((?:[+-]\d{6}|\d{4})(?:\d\d\d\d|W\d\d\d|W\d\d|\d\d\d|\d\d|))(?:(T| )(\d\d(?:\d\d(?:\d\d(?:[.,]\d+)?)?)?)([+-]\d\d(?::?\d\d)?|\s*Z)?)?$/,
            at = /Z|[+-]\d\d(?::?\d\d)?/,
            rt = [
                ["YYYYYY-MM-DD", /[+-]\d{6}-\d\d-\d\d/],
                ["YYYY-MM-DD", /\d{4}-\d\d-\d\d/],
                ["GGGG-[W]WW-E", /\d{4}-W\d\d-\d/],
                ["GGGG-[W]WW", /\d{4}-W\d\d/, !1],
                ["YYYY-DDD", /\d{4}-\d{3}/],
                ["YYYY-MM", /\d{4}-\d\d/, !1],
                ["YYYYYYMMDD", /[+-]\d{10}/],
                ["YYYYMMDD", /\d{8}/],
                ["GGGG[W]WWE", /\d{4}W\d{3}/],
                ["GGGG[W]WW", /\d{4}W\d{2}/, !1],
                ["YYYYDDD", /\d{7}/],
                ["YYYYMM", /\d{6}/, !1],
                ["YYYY", /\d{4}/, !1],
            ],
            ot = [
                ["HH:mm:ss.SSSS", /\d\d:\d\d:\d\d\.\d+/],
                ["HH:mm:ss,SSSS", /\d\d:\d\d:\d\d,\d+/],
                ["HH:mm:ss", /\d\d:\d\d:\d\d/],
                ["HH:mm", /\d\d:\d\d/],
                ["HHmmss.SSSS", /\d\d\d\d\d\d\.\d+/],
                ["HHmmss,SSSS", /\d\d\d\d\d\d,\d+/],
                ["HHmmss", /\d\d\d\d\d\d/],
                ["HHmm", /\d\d\d\d/],
                ["HH", /\d\d/],
            ],
            lt = /^\/?Date\((-?\d+)/i,
            ut =
                /^(?:(Mon|Tue|Wed|Thu|Fri|Sat|Sun),?\s)?(\d{1,2})\s(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\s(\d{2,4})\s(\d\d):(\d\d)(?::(\d\d))?\s(?:(UT|GMT|[ECMP][SD]T)|([Zz])|([+-]\d{4}))$/,
            dt = {
                UT: 0,
                GMT: 0,
                EDT: -240,
                EST: -300,
                CDT: -300,
                CST: -360,
                MDT: -360,
                MST: -420,
                PDT: -420,
                PST: -480,
            };
        function ct(e) {
            var t,
                i,
                n,
                s,
                a,
                r,
                o = e._i,
                l = nt.exec(o) || st.exec(o),
                u = ((o = rt.length), ot.length);
            if (l) {
                for (h(e).iso = !0, t = 0, i = o; t < i; t++)
                    if (rt[t][1].exec(l[1])) {
                        (s = rt[t][0]), (n = !1 !== rt[t][2]);
                        break;
                    }
                if (null == s) e._isValid = !1;
                else {
                    if (l[3]) {
                        for (t = 0, i = u; t < i; t++)
                            if (ot[t][1].exec(l[3])) {
                                a = (l[2] || " ") + ot[t][0];
                                break;
                            }
                        if (null == a) return void (e._isValid = !1);
                    }
                    if (n || null == a) {
                        if (l[4]) {
                            if (!at.exec(l[4])) return void (e._isValid = !1);
                            r = "Z";
                        }
                        (e._f = s + (a || "") + (r || "")), mt(e);
                    } else e._isValid = !1;
                }
            } else e._isValid = !1;
        }
        function ht(e) {
            var t,
                i,
                n,
                s,
                a = ut.exec(
                    e._i
                        .replace(/\([^()]*\)|[\n\t]/g, " ")
                        .replace(/(\s\s+)/g, " ")
                        .replace(/^\s\s*/, "")
                        .replace(/\s\s*$/, "")
                );
            a
                ? ((t = (function (e, t, i, n, s, a) {
                      return (
                          (e = [
                              (function (e) {
                                  return (e = parseInt(e, 10)) <= 49
                                      ? 2e3 + e
                                      : e <= 999
                                      ? 1900 + e
                                      : e;
                              })(e),
                              xe.indexOf(t),
                              parseInt(i, 10),
                              parseInt(n, 10),
                              parseInt(s, 10),
                          ]),
                          a && e.push(parseInt(a, 10)),
                          e
                      );
                  })(a[4], a[3], a[2], a[5], a[6], a[7])),
                  (n = t),
                  (s = e),
                  (i = a[1]) &&
                  $e.indexOf(i) !== new Date(n[0], n[1], n[2]).getDay()
                      ? ((h(s).weekdayMismatch = !0), (s._isValid = !1))
                      : ((e._a = t),
                        (e._tzm =
                            ((i = a[8]),
                            (n = a[9]),
                            (s = a[10]),
                            i
                                ? dt[i]
                                : n
                                ? 0
                                : (((i = parseInt(s, 10)) - (n = i % 100)) /
                                      100) *
                                      60 +
                                  n)),
                        (e._d = Le.apply(null, e._a)),
                        e._d.setUTCMinutes(e._d.getUTCMinutes() - e._tzm),
                        (h(e).rfc2822 = !0)))
                : (e._isValid = !1);
        }
        function ft(e, t, i) {
            return null != e ? e : null != t ? t : i;
        }
        function pt(e) {
            var i,
                n,
                s,
                a,
                r,
                o,
                l,
                u,
                d,
                c,
                f,
                p = [];
            if (!e._d) {
                for (
                    s = e,
                        a = new Date(t.now()),
                        n = s._useUTC
                            ? [
                                  a.getUTCFullYear(),
                                  a.getUTCMonth(),
                                  a.getUTCDate(),
                              ]
                            : [a.getFullYear(), a.getMonth(), a.getDate()],
                        e._w &&
                            null == e._a[2] &&
                            null == e._a[1] &&
                            (null != (a = (s = e)._w).GG ||
                            null != a.W ||
                            null != a.E
                                ? ((u = 1),
                                  (d = 4),
                                  (r = ft(a.GG, s._a[0], Ne(yt(), 1, 4).year)),
                                  (o = ft(a.W, 1)),
                                  ((l = ft(a.E, 1)) < 1 || 7 < l) && (c = !0))
                                : ((u = s._locale._week.dow),
                                  (d = s._locale._week.doy),
                                  (f = Ne(yt(), u, d)),
                                  (r = ft(a.gg, s._a[0], f.year)),
                                  (o = ft(a.w, f.week)),
                                  null != a.d
                                      ? ((l = a.d) < 0 || 6 < l) && (c = !0)
                                      : null != a.e
                                      ? ((l = a.e + u),
                                        (a.e < 0 || 6 < a.e) && (c = !0))
                                      : (l = u)),
                            o < 1 || o > Ie(r, u, d)
                                ? (h(s)._overflowWeeks = !0)
                                : null != c
                                ? (h(s)._overflowWeekday = !0)
                                : ((f = Oe(r, o, l, u, d)),
                                  (s._a[0] = f.year),
                                  (s._dayOfYear = f.dayOfYear))),
                        null != e._dayOfYear &&
                            ((a = ft(e._a[0], n[0])),
                            (e._dayOfYear > Ce(a) || 0 === e._dayOfYear) &&
                                (h(e)._overflowDayOfYear = !0),
                            (c = Le(a, 0, e._dayOfYear)),
                            (e._a[1] = c.getUTCMonth()),
                            (e._a[2] = c.getUTCDate())),
                        i = 0;
                    i < 3 && null == e._a[i];
                    ++i
                )
                    e._a[i] = p[i] = n[i];
                for (; i < 7; i++)
                    e._a[i] = p[i] =
                        null == e._a[i] ? (2 === i ? 1 : 0) : e._a[i];
                24 === e._a[3] &&
                    0 === e._a[4] &&
                    0 === e._a[5] &&
                    0 === e._a[6] &&
                    ((e._nextDay = !0), (e._a[3] = 0)),
                    (e._d = (e._useUTC ? Le : Pe).apply(null, p)),
                    (r = e._useUTC ? e._d.getUTCDay() : e._d.getDay()),
                    null != e._tzm &&
                        e._d.setUTCMinutes(e._d.getUTCMinutes() - e._tzm),
                    e._nextDay && (e._a[3] = 24),
                    e._w &&
                        void 0 !== e._w.d &&
                        e._w.d !== r &&
                        (h(e).weekdayMismatch = !0);
            }
        }
        function mt(e) {
            if (e._f === t.ISO_8601) ct(e);
            else if (e._f === t.RFC_2822) ht(e);
            else {
                (e._a = []), (h(e).empty = !0);
                for (
                    var i,
                        n,
                        a,
                        r,
                        o,
                        l = "" + e._i,
                        u = l.length,
                        d = 0,
                        c = R(e._f, e._locale).match(P) || [],
                        f = c.length,
                        p = 0;
                    p < f;
                    p++
                )
                    (n = c[p]),
                        (i = (l.match(he(n, e)) || [])[0]) &&
                            (0 < (a = l.substr(0, l.indexOf(i))).length &&
                                h(e).unusedInput.push(a),
                            (l = l.slice(l.indexOf(i) + i.length)),
                            (d += i.length)),
                        O[n]
                            ? (i
                                  ? (h(e).empty = !1)
                                  : h(e).unusedTokens.push(n),
                              (a = n),
                              (o = e),
                              null != (r = i) &&
                                  s(me, a) &&
                                  me[a](r, o._a, o, a))
                            : e._strict && !i && h(e).unusedTokens.push(n);
                (h(e).charsLeftOver = u - d),
                    0 < l.length && h(e).unusedInput.push(l),
                    e._a[3] <= 12 &&
                        !0 === h(e).bigHour &&
                        0 < e._a[3] &&
                        (h(e).bigHour = void 0),
                    (h(e).parsedDateParts = e._a.slice(0)),
                    (h(e).meridiem = e._meridiem),
                    (e._a[3] = (function (e, t, i) {
                        return null == i
                            ? t
                            : null != e.meridiemHour
                            ? e.meridiemHour(t, i)
                            : null != e.isPM
                            ? ((e = e.isPM(i)) && t < 12 && (t += 12),
                              (t = e || 12 !== t ? t : 0))
                            : t;
                    })(e._locale, e._a[3], e._meridiem)),
                    null !== (u = h(e).era) &&
                        (e._a[0] = e._locale.erasConvertYear(u, e._a[0])),
                    pt(e),
                    it(e);
            }
        }
        function gt(e) {
            var s,
                a,
                c,
                m = e._i,
                g = e._f;
            return (
                (e._locale = e._locale || tt(e._l)),
                null === m || (void 0 === g && "" === m)
                    ? p({ nullInput: !0 })
                    : ("string" == typeof m &&
                          (e._i = m = e._locale.preparse(m)),
                      _(m)
                          ? new b(it(m))
                          : (l(m)
                                ? (e._d = m)
                                : i(g)
                                ? (function (e) {
                                      var t,
                                          i,
                                          n,
                                          s,
                                          a,
                                          r,
                                          o = !1,
                                          l = e._f.length;
                                      if (0 === l)
                                          return (
                                              (h(e).invalidFormat = !0),
                                              (e._d = new Date(NaN))
                                          );
                                      for (s = 0; s < l; s++)
                                          (a = 0),
                                              (r = !1),
                                              (t = y({}, e)),
                                              null != e._useUTC &&
                                                  (t._useUTC = e._useUTC),
                                              (t._f = e._f[s]),
                                              mt(t),
                                              f(t) && (r = !0),
                                              (a =
                                                  (a += h(t).charsLeftOver) +
                                                  10 *
                                                      h(t).unusedTokens.length),
                                              (h(t).score = a),
                                              o
                                                  ? a < n && ((n = a), (i = t))
                                                  : (null == n || a < n || r) &&
                                                    ((n = a),
                                                    (i = t),
                                                    r && (o = !0));
                                      d(e, i || t);
                                  })(e)
                                : g
                                ? mt(e)
                                : r((g = (m = e)._i))
                                ? (m._d = new Date(t.now()))
                                : l(g)
                                ? (m._d = new Date(g.valueOf()))
                                : "string" == typeof g
                                ? ((a = m),
                                  null !== (s = lt.exec(a._i))
                                      ? (a._d = new Date(+s[1]))
                                      : (ct(a),
                                        !1 === a._isValid &&
                                            (delete a._isValid,
                                            ht(a),
                                            !1 === a._isValid &&
                                                (delete a._isValid,
                                                a._strict
                                                    ? (a._isValid = !1)
                                                    : t.createFromInputFallback(
                                                          a
                                                      )))))
                                : i(g)
                                ? ((m._a = u(g.slice(0), function (e) {
                                      return parseInt(e, 10);
                                  })),
                                  pt(m))
                                : n(g)
                                ? (s = m)._d ||
                                  ((c =
                                      void 0 === (a = H(s._i)).day
                                          ? a.date
                                          : a.day),
                                  (s._a = u(
                                      [
                                          a.year,
                                          a.month,
                                          c,
                                          a.hour,
                                          a.minute,
                                          a.second,
                                          a.millisecond,
                                      ],
                                      function (e) {
                                          return e && parseInt(e, 10);
                                      }
                                  )),
                                  pt(s))
                                : o(g)
                                ? (m._d = new Date(g))
                                : t.createFromInputFallback(m),
                            f(e) || (e._d = null),
                            e))
            );
        }
        function vt(e, t, s, r, o) {
            var l = {};
            return (
                (!0 !== t && !1 !== t) || ((r = t), (t = void 0)),
                (!0 !== s && !1 !== s) || ((r = s), (s = void 0)),
                ((n(e) && a(e)) || (i(e) && 0 === e.length)) && (e = void 0),
                (l._isAMomentObject = !0),
                (l._useUTC = l._isUTC = o),
                (l._l = s),
                (l._i = e),
                (l._f = t),
                (l._strict = r),
                (o = new b(it(gt((o = l)))))._nextDay &&
                    (o.add(1, "d"), (o._nextDay = void 0)),
                o
            );
        }
        function yt(e, t, i, n) {
            return vt(e, t, i, n, !1);
        }
        function bt(e, t) {
            var n, s;
            if (!(t = 1 === t.length && i(t[0]) ? t[0] : t).length) return yt();
            for (n = t[0], s = 1; s < t.length; ++s)
                (t[s].isValid() && !t[s][e](n)) || (n = t[s]);
            return n;
        }
        (t.createFromInputFallback = w(
            "value provided is not in a recognized RFC2822 or ISO format. moment construction falls back to js Date(), which is not reliable across all browsers and versions. Non RFC2822/ISO date formats are discouraged. Please refer to http://momentjs.com/guides/#/warnings/js-date/ for more info.",
            function (e) {
                e._d = new Date(e._i + (e._useUTC ? " UTC" : ""));
            }
        )),
            (t.ISO_8601 = function () {}),
            (t.RFC_2822 = function () {}),
            (te = w(
                "moment().min is deprecated, use moment.max instead. http://momentjs.com/guides/#/warnings/min-max/",
                function () {
                    var e = yt.apply(null, arguments);
                    return this.isValid() && e.isValid()
                        ? e < this
                            ? this
                            : e
                        : p();
                }
            )),
            (ie = w(
                "moment().max is deprecated, use moment.min instead. http://momentjs.com/guides/#/warnings/min-max/",
                function () {
                    var e = yt.apply(null, arguments);
                    return this.isValid() && e.isValid()
                        ? this < e
                            ? this
                            : e
                        : p();
                }
            ));
        var _t = [
            "year",
            "quarter",
            "month",
            "week",
            "day",
            "hour",
            "minute",
            "second",
            "millisecond",
        ];
        function xt(e) {
            var t = (e = H(e)).year || 0,
                i = e.quarter || 0,
                n = e.month || 0,
                a = e.week || e.isoWeek || 0,
                r = e.day || 0,
                o = e.hour || 0,
                l = e.minute || 0,
                u = e.second || 0,
                d = e.millisecond || 0;
            (this._isValid = (function (e) {
                var t,
                    i,
                    n = !1,
                    a = _t.length;
                for (t in e)
                    if (
                        s(e, t) &&
                        (-1 === ye.call(_t, t) || (null != e[t] && isNaN(e[t])))
                    )
                        return !1;
                for (i = 0; i < a; ++i)
                    if (e[_t[i]]) {
                        if (n) return !1;
                        parseFloat(e[_t[i]]) !== V(e[_t[i]]) && (n = !0);
                    }
                return !0;
            })(e)),
                (this._milliseconds =
                    +d + 1e3 * u + 6e4 * l + 1e3 * o * 60 * 60),
                (this._days = +r + 7 * a),
                (this._months = +n + 3 * i + 12 * t),
                (this._data = {}),
                (this._locale = tt()),
                this._bubble();
        }
        function wt(e) {
            return e instanceof xt;
        }
        function St(e) {
            return e < 0 ? -1 * Math.round(-1 * e) : Math.round(e);
        }
        function Mt(e, t) {
            N(e, 0, 0, function () {
                var e = this.utcOffset(),
                    i = "+";
                return (
                    e < 0 && ((e = -e), (i = "-")),
                    i + A(~~(e / 60), 2) + t + A(~~e % 60, 2)
                );
            });
        }
        Mt("Z", ":"),
            Mt("ZZ", ""),
            ce("Z", ue),
            ce("ZZ", ue),
            ge(["Z", "ZZ"], function (e, t, i) {
                (i._useUTC = !0), (i._tzm = kt(ue, e));
            });
        var Et = /([\+\-]|\d\d)/gi;
        function kt(e, t) {
            return null === (t = (t || "").match(e))
                ? null
                : 0 ===
                  (t =
                      60 *
                          (e = ((t[t.length - 1] || []) + "").match(Et) || [
                              "-",
                              0,
                              0,
                          ])[1] +
                      V(e[2]))
                ? 0
                : "+" === e[0]
                ? t
                : -t;
        }
        function Tt(e, i) {
            var n;
            return i._isUTC
                ? ((i = i.clone()),
                  (n = (_(e) || l(e) ? e : yt(e)).valueOf() - i.valueOf()),
                  i._d.setTime(i._d.valueOf() + n),
                  t.updateOffset(i, !1),
                  i)
                : yt(e).local();
        }
        function Ct(e) {
            return -Math.round(e._d.getTimezoneOffset());
        }
        function At() {
            return !!this.isValid() && this._isUTC && 0 === this._offset;
        }
        t.updateOffset = function () {};
        var Pt = /^(-|\+)?(?:(\d*)[. ])?(\d+):(\d+)(?::(\d+)(\.\d*)?)?$/,
            Lt =
                /^(-|\+)?P(?:([-+]?[0-9,.]*)Y)?(?:([-+]?[0-9,.]*)M)?(?:([-+]?[0-9,.]*)W)?(?:([-+]?[0-9,.]*)D)?(?:T(?:([-+]?[0-9,.]*)H)?(?:([-+]?[0-9,.]*)M)?(?:([-+]?[0-9,.]*)S)?)?$/;
        function Dt(e, t) {
            var i,
                n = e,
                a = null;
            return (
                wt(e)
                    ? (n = { ms: e._milliseconds, d: e._days, M: e._months })
                    : o(e) || !isNaN(+e)
                    ? ((n = {}), t ? (n[t] = +e) : (n.milliseconds = +e))
                    : (a = Pt.exec(e))
                    ? ((i = "-" === a[1] ? -1 : 1),
                      (n = {
                          y: 0,
                          d: V(a[2]) * i,
                          h: V(a[3]) * i,
                          m: V(a[4]) * i,
                          s: V(a[5]) * i,
                          ms: V(St(1e3 * a[6])) * i,
                      }))
                    : (a = Lt.exec(e))
                    ? ((i = "-" === a[1] ? -1 : 1),
                      (n = {
                          y: Ot(a[2], i),
                          M: Ot(a[3], i),
                          w: Ot(a[4], i),
                          d: Ot(a[5], i),
                          h: Ot(a[6], i),
                          m: Ot(a[7], i),
                          s: Ot(a[8], i),
                      }))
                    : null == n
                    ? (n = {})
                    : "object" == typeof n &&
                      ("from" in n || "to" in n) &&
                      ((t = (function (e, t) {
                          var i;
                          return e.isValid() && t.isValid()
                              ? ((t = Tt(t, e)),
                                e.isBefore(t)
                                    ? (i = Nt(e, t))
                                    : (((i = Nt(t, e)).milliseconds =
                                          -i.milliseconds),
                                      (i.months = -i.months)),
                                i)
                              : { milliseconds: 0, months: 0 };
                      })(yt(n.from), yt(n.to))),
                      ((n = {}).ms = t.milliseconds),
                      (n.M = t.months)),
                (a = new xt(n)),
                wt(e) && s(e, "_locale") && (a._locale = e._locale),
                wt(e) && s(e, "_isValid") && (a._isValid = e._isValid),
                a
            );
        }
        function Ot(e, t) {
            return (
                (e = e && parseFloat(e.replace(",", "."))),
                (isNaN(e) ? 0 : e) * t
            );
        }
        function Nt(e, t) {
            var i = {};
            return (
                (i.months = t.month() - e.month() + 12 * (t.year() - e.year())),
                e.clone().add(i.months, "M").isAfter(t) && --i.months,
                (i.milliseconds = +t - +e.clone().add(i.months, "M")),
                i
            );
        }
        function It(e, t) {
            return function (i, n) {
                var s;
                return (
                    null === n ||
                        isNaN(+n) ||
                        (M(
                            t,
                            "moment()." +
                                t +
                                "(period, number) is deprecated. Please use moment()." +
                                t +
                                "(number, period). See http://momentjs.com/guides/#/warnings/add-inverted-param/ for more info."
                        ),
                        (s = i),
                        (i = n),
                        (n = s)),
                    Rt(this, Dt(i, n), e),
                    this
                );
            };
        }
        function Rt(e, i, n, s) {
            var a = i._milliseconds,
                r = St(i._days);
            i = St(i._months);
            e.isValid() &&
                ((s = null == s || s),
                i && Ee(e, U(e, "Month") + i * n),
                r && X(e, "Date", U(e, "Date") + r * n),
                a && e._d.setTime(e._d.valueOf() + a * n),
                s && t.updateOffset(e, r || i));
        }
        function zt(e) {
            return "string" == typeof e || e instanceof String;
        }
        function $t(e) {
            return (
                _(e) ||
                l(e) ||
                zt(e) ||
                o(e) ||
                (function (e) {
                    var t = i(e),
                        n = !1;
                    return (
                        t &&
                            (n =
                                0 ===
                                e.filter(function (t) {
                                    return !o(t) && zt(e);
                                }).length),
                        t && n
                    );
                })(e) ||
                (function (e) {
                    var t,
                        i = n(e) && !a(e),
                        r = !1,
                        o = [
                            "years",
                            "year",
                            "y",
                            "months",
                            "month",
                            "M",
                            "days",
                            "day",
                            "d",
                            "dates",
                            "date",
                            "D",
                            "hours",
                            "hour",
                            "h",
                            "minutes",
                            "minute",
                            "m",
                            "seconds",
                            "second",
                            "s",
                            "milliseconds",
                            "millisecond",
                            "ms",
                        ],
                        l = o.length;
                    for (t = 0; t < l; t += 1) r = r || s(e, o[t]);
                    return i && r;
                })(e) ||
                null == e
            );
        }
        function Ft(e, t) {
            if (e.date() < t.date()) return -Ft(t, e);
            var i = 12 * (t.year() - e.year()) + (t.month() - e.month()),
                n = e.clone().add(i, "months");
            return (
                -(
                    i +
                    (t =
                        t - n < 0
                            ? (t - n) / (n - e.clone().add(i - 1, "months"))
                            : (t - n) / (e.clone().add(1 + i, "months") - n))
                ) || 0
            );
        }
        function Ht(e) {
            return void 0 === e
                ? this._locale._abbr
                : (null != (e = tt(e)) && (this._locale = e), this);
        }
        function jt() {
            return this._locale;
        }
        (Dt.fn = xt.prototype),
            (Dt.invalid = function () {
                return Dt(NaN);
            }),
            (_e = It(1, "add")),
            (ze = It(-1, "subtract")),
            (t.defaultFormat = "YYYY-MM-DDTHH:mm:ssZ"),
            (t.defaultFormatUtc = "YYYY-MM-DDTHH:mm:ss[Z]"),
            (Fe = w(
                "moment().lang() is deprecated. Instead, use moment().localeData() to get the language configuration. Use moment().locale() to change languages.",
                function (e) {
                    return void 0 === e ? this.localeData() : this.locale(e);
                }
            ));
        var Wt = 126227808e5;
        function Yt(e, t) {
            return ((e % t) + t) % t;
        }
        function Bt(e, t, i) {
            return e < 100 && 0 <= e
                ? new Date(e + 400, t, i) - Wt
                : new Date(e, t, i).valueOf();
        }
        function Vt(e, t, i) {
            return e < 100 && 0 <= e
                ? Date.UTC(e + 400, t, i) - Wt
                : Date.UTC(e, t, i);
        }
        function qt(e, t) {
            return t.erasAbbrRegex(e);
        }
        function Ut() {
            for (
                var e = [],
                    t = [],
                    i = [],
                    n = [],
                    s = this.eras(),
                    a = 0,
                    r = s.length;
                a < r;
                ++a
            )
                t.push(fe(s[a].name)),
                    e.push(fe(s[a].abbr)),
                    i.push(fe(s[a].narrow)),
                    n.push(fe(s[a].name)),
                    n.push(fe(s[a].abbr)),
                    n.push(fe(s[a].narrow));
            (this._erasRegex = new RegExp("^(" + n.join("|") + ")", "i")),
                (this._erasNameRegex = new RegExp(
                    "^(" + t.join("|") + ")",
                    "i"
                )),
                (this._erasAbbrRegex = new RegExp(
                    "^(" + e.join("|") + ")",
                    "i"
                )),
                (this._erasNarrowRegex = new RegExp(
                    "^(" + i.join("|") + ")",
                    "i"
                ));
        }
        function Xt(e, t) {
            N(0, [e, e.length], 0, t);
        }
        function Gt(e, t, i, n, s) {
            var a;
            return null == e
                ? Ne(this, n, s).year
                : ((a = Ie(e, n, s)),
                  function (e, t, i, n, s) {
                      return (
                          (t = Le(
                              (e = Oe(e, t, i, n, s)).year,
                              0,
                              e.dayOfYear
                          )),
                          this.year(t.getUTCFullYear()),
                          this.month(t.getUTCMonth()),
                          this.date(t.getUTCDate()),
                          this
                      );
                  }.call(this, e, (t = a < t ? a : t), i, n, s));
        }
        N("N", 0, 0, "eraAbbr"),
            N("NN", 0, 0, "eraAbbr"),
            N("NNN", 0, 0, "eraAbbr"),
            N("NNNN", 0, 0, "eraName"),
            N("NNNNN", 0, 0, "eraNarrow"),
            N("y", ["y", 1], "yo", "eraYear"),
            N("y", ["yy", 2], 0, "eraYear"),
            N("y", ["yyy", 3], 0, "eraYear"),
            N("y", ["yyyy", 4], 0, "eraYear"),
            ce("N", qt),
            ce("NN", qt),
            ce("NNN", qt),
            ce("NNNN", function (e, t) {
                return t.erasNameRegex(e);
            }),
            ce("NNNNN", function (e, t) {
                return t.erasNarrowRegex(e);
            }),
            ge(["N", "NN", "NNN", "NNNN", "NNNNN"], function (e, t, i, n) {
                (n = i._locale.erasParse(e, n, i._strict))
                    ? (h(i).era = n)
                    : (h(i).invalidEra = e);
            }),
            ce("y", re),
            ce("yy", re),
            ce("yyy", re),
            ce("yyyy", re),
            ce("yo", function (e, t) {
                return t._eraYearOrdinalRegex || re;
            }),
            ge(["y", "yy", "yyy", "yyyy"], 0),
            ge(["yo"], function (e, t, i, n) {
                var s;
                i._locale._eraYearOrdinalRegex &&
                    (s = e.match(i._locale._eraYearOrdinalRegex)),
                    i._locale.eraYearOrdinalParse
                        ? (t[0] = i._locale.eraYearOrdinalParse(e, s))
                        : (t[0] = parseInt(e, 10));
            }),
            N(0, ["gg", 2], 0, function () {
                return this.weekYear() % 100;
            }),
            N(0, ["GG", 2], 0, function () {
                return this.isoWeekYear() % 100;
            }),
            Xt("gggg", "weekYear"),
            Xt("ggggg", "weekYear"),
            Xt("GGGG", "isoWeekYear"),
            Xt("GGGGG", "isoWeekYear"),
            $("weekYear", "gg"),
            $("isoWeekYear", "GG"),
            W("weekYear", 1),
            W("isoWeekYear", 1),
            ce("G", oe),
            ce("g", oe),
            ce("GG", ee, K),
            ce("gg", ee, K),
            ce("GGGG", se, Z),
            ce("gggg", se, Z),
            ce("GGGGG", ae, J),
            ce("ggggg", ae, J),
            ve(["gggg", "ggggg", "GGGG", "GGGGG"], function (e, t, i, n) {
                t[n.substr(0, 2)] = V(e);
            }),
            ve(["gg", "GG"], function (e, i, n, s) {
                i[s] = t.parseTwoDigitYear(e);
            }),
            N("Q", 0, "Qo", "quarter"),
            $("quarter", "Q"),
            W("quarter", 7),
            ce("Q", G),
            ge("Q", function (e, t) {
                t[1] = 3 * (V(e) - 1);
            }),
            N("D", ["DD", 2], "Do", "date"),
            $("date", "D"),
            W("date", 9),
            ce("D", ee),
            ce("DD", ee, K),
            ce("Do", function (e, t) {
                return e
                    ? t._dayOfMonthOrdinalParse || t._ordinalParse
                    : t._dayOfMonthOrdinalParseLenient;
            }),
            ge(["D", "DD"], 2),
            ge("Do", function (e, t) {
                t[2] = V(e.match(ee)[0]);
            }),
            (se = q("Date", !0)),
            N("DDD", ["DDDD", 3], "DDDo", "dayOfYear"),
            $("dayOfYear", "DDD"),
            W("dayOfYear", 4),
            ce("DDD", ne),
            ce("DDDD", Q),
            ge(["DDD", "DDDD"], function (e, t, i) {
                i._dayOfYear = V(e);
            }),
            N("m", ["mm", 2], 0, "minute"),
            $("minute", "m"),
            W("minute", 14),
            ce("m", ee),
            ce("mm", ee, K),
            ge(["m", "mm"], 4);
        var Kt;
        (Z = q("Minutes", !1)),
            N("s", ["ss", 2], 0, "second"),
            $("second", "s"),
            W("second", 15),
            ce("s", ee),
            ce("ss", ee, K),
            ge(["s", "ss"], 5),
            (ae = q("Seconds", !1));
        for (
            N("S", 0, 0, function () {
                return ~~(this.millisecond() / 100);
            }),
                N(0, ["SS", 2], 0, function () {
                    return ~~(this.millisecond() / 10);
                }),
                N(0, ["SSS", 3], 0, "millisecond"),
                N(0, ["SSSS", 4], 0, function () {
                    return 10 * this.millisecond();
                }),
                N(0, ["SSSSS", 5], 0, function () {
                    return 100 * this.millisecond();
                }),
                N(0, ["SSSSSS", 6], 0, function () {
                    return 1e3 * this.millisecond();
                }),
                N(0, ["SSSSSSS", 7], 0, function () {
                    return 1e4 * this.millisecond();
                }),
                N(0, ["SSSSSSSS", 8], 0, function () {
                    return 1e5 * this.millisecond();
                }),
                N(0, ["SSSSSSSSS", 9], 0, function () {
                    return 1e6 * this.millisecond();
                }),
                $("millisecond", "ms"),
                W("millisecond", 16),
                ce("S", ne, G),
                ce("SS", ne, K),
                ce("SSS", ne, Q),
                Kt = "SSSS";
            Kt.length <= 9;
            Kt += "S"
        )
            ce(Kt, re);
        function Qt(e, t) {
            t[6] = V(1e3 * ("0." + e));
        }
        for (Kt = "S"; Kt.length <= 9; Kt += "S") ge(Kt, Qt);
        function Zt(e) {
            return e;
        }
        function Jt(e, t, i, n) {
            var s = tt();
            n = c().set(n, t);
            return s[i](n, e);
        }
        function ei(e, t, i) {
            if ((o(e) && ((t = e), (e = void 0)), (e = e || ""), null != t))
                return Jt(e, t, i, "month");
            for (var n = [], s = 0; s < 12; s++) n[s] = Jt(e, s, i, "month");
            return n;
        }
        function ti(e, t, i, n) {
            "boolean" == typeof e
                ? o(t) && ((i = t), (t = void 0))
                : ((t = e), (e = !1), o((i = t)) && ((i = t), (t = void 0))),
                (t = t || "");
            var s,
                a = tt(),
                r = e ? a._week.dow : 0,
                l = [];
            if (null != i) return Jt(t, (i + r) % 7, n, "day");
            for (s = 0; s < 7; s++) l[s] = Jt(t, (s + r) % 7, n, "day");
            return l;
        }
        (J = q("Milliseconds", !1)),
            N("z", 0, 0, "zoneAbbr"),
            N("zz", 0, 0, "zoneName"),
            ((G = b.prototype).add = _e),
            (G.calendar = function (e, i) {
                1 === arguments.length &&
                    (arguments[0]
                        ? $t(arguments[0])
                            ? ((e = arguments[0]), (i = void 0))
                            : (function (e) {
                                  for (
                                      var t = n(e) && !a(e),
                                          i = !1,
                                          r = [
                                              "sameDay",
                                              "nextDay",
                                              "lastDay",
                                              "nextWeek",
                                              "lastWeek",
                                              "sameElse",
                                          ],
                                          o = 0;
                                      o < r.length;
                                      o += 1
                                  )
                                      i = i || s(e, r[o]);
                                  return t && i;
                              })(arguments[0]) &&
                              ((i = arguments[0]), (e = void 0))
                        : (i = e = void 0));
                var r = Tt((e = e || yt()), this).startOf("day");
                (r = t.calendarFormat(this, r) || "sameElse"),
                    (i = i && (E(i[r]) ? i[r].call(this, e) : i[r]));
                return this.format(
                    i || this.localeData().calendar(r, this, yt(e))
                );
            }),
            (G.clone = function () {
                return new b(this);
            }),
            (G.diff = function (e, t, i) {
                var n, s, a;
                if (!this.isValid()) return NaN;
                if (!(n = Tt(e, this)).isValid()) return NaN;
                switch (
                    ((s = 6e4 * (n.utcOffset() - this.utcOffset())), (t = F(t)))
                ) {
                    case "year":
                        a = Ft(this, n) / 12;
                        break;
                    case "month":
                        a = Ft(this, n);
                        break;
                    case "quarter":
                        a = Ft(this, n) / 3;
                        break;
                    case "second":
                        a = (this - n) / 1e3;
                        break;
                    case "minute":
                        a = (this - n) / 6e4;
                        break;
                    case "hour":
                        a = (this - n) / 36e5;
                        break;
                    case "day":
                        a = (this - n - s) / 864e5;
                        break;
                    case "week":
                        a = (this - n - s) / 6048e5;
                        break;
                    default:
                        a = this - n;
                }
                return i ? a : B(a);
            }),
            (G.endOf = function (e) {
                var i, n;
                if (
                    void 0 === (e = F(e)) ||
                    "millisecond" === e ||
                    !this.isValid()
                )
                    return this;
                switch (((n = this._isUTC ? Vt : Bt), e)) {
                    case "year":
                        i = n(this.year() + 1, 0, 1) - 1;
                        break;
                    case "quarter":
                        i =
                            n(
                                this.year(),
                                this.month() - (this.month() % 3) + 3,
                                1
                            ) - 1;
                        break;
                    case "month":
                        i = n(this.year(), this.month() + 1, 1) - 1;
                        break;
                    case "week":
                        i =
                            n(
                                this.year(),
                                this.month(),
                                this.date() - this.weekday() + 7
                            ) - 1;
                        break;
                    case "isoWeek":
                        i =
                            n(
                                this.year(),
                                this.month(),
                                this.date() - (this.isoWeekday() - 1) + 7
                            ) - 1;
                        break;
                    case "day":
                    case "date":
                        i = n(this.year(), this.month(), this.date() + 1) - 1;
                        break;
                    case "hour":
                        (i = this._d.valueOf()),
                            (i +=
                                36e5 -
                                Yt(
                                    i +
                                        (this._isUTC
                                            ? 0
                                            : 6e4 * this.utcOffset()),
                                    36e5
                                ) -
                                1);
                        break;
                    case "minute":
                        (i = this._d.valueOf()), (i += 6e4 - Yt(i, 6e4) - 1);
                        break;
                    case "second":
                        (i = this._d.valueOf()), (i += 1e3 - Yt(i, 1e3) - 1);
                }
                return this._d.setTime(i), t.updateOffset(this, !0), this;
            }),
            (G.format = function (e) {
                return (
                    (e = I(
                        this,
                        (e =
                            e ||
                            (this.isUtc()
                                ? t.defaultFormatUtc
                                : t.defaultFormat))
                    )),
                    this.localeData().postformat(e)
                );
            }),
            (G.from = function (e, t) {
                return this.isValid() &&
                    ((_(e) && e.isValid()) || yt(e).isValid())
                    ? Dt({ to: this, from: e })
                          .locale(this.locale())
                          .humanize(!t)
                    : this.localeData().invalidDate();
            }),
            (G.fromNow = function (e) {
                return this.from(yt(), e);
            }),
            (G.to = function (e, t) {
                return this.isValid() &&
                    ((_(e) && e.isValid()) || yt(e).isValid())
                    ? Dt({ from: this, to: e })
                          .locale(this.locale())
                          .humanize(!t)
                    : this.localeData().invalidDate();
            }),
            (G.toNow = function (e) {
                return this.to(yt(), e);
            }),
            (G.get = function (e) {
                return E(this[(e = F(e))]) ? this[e]() : this;
            }),
            (G.invalidAt = function () {
                return h(this).overflow;
            }),
            (G.isAfter = function (e, t) {
                return (
                    (e = _(e) ? e : yt(e)),
                    !(!this.isValid() || !e.isValid()) &&
                        ("millisecond" === (t = F(t) || "millisecond")
                            ? this.valueOf() > e.valueOf()
                            : e.valueOf() < this.clone().startOf(t).valueOf())
                );
            }),
            (G.isBefore = function (e, t) {
                return (
                    (e = _(e) ? e : yt(e)),
                    !(!this.isValid() || !e.isValid()) &&
                        ("millisecond" === (t = F(t) || "millisecond")
                            ? this.valueOf() < e.valueOf()
                            : this.clone().endOf(t).valueOf() < e.valueOf())
                );
            }),
            (G.isBetween = function (e, t, i, n) {
                return (
                    (e = _(e) ? e : yt(e)),
                    (t = _(t) ? t : yt(t)),
                    !!(this.isValid() && e.isValid() && t.isValid()) &&
                        ("(" === (n = n || "()")[0]
                            ? this.isAfter(e, i)
                            : !this.isBefore(e, i)) &&
                        (")" === n[1]
                            ? this.isBefore(t, i)
                            : !this.isAfter(t, i))
                );
            }),
            (G.isSame = function (e, t) {
                e = _(e) ? e : yt(e);
                return (
                    !(!this.isValid() || !e.isValid()) &&
                    ("millisecond" === (t = F(t) || "millisecond")
                        ? this.valueOf() === e.valueOf()
                        : ((e = e.valueOf()),
                          this.clone().startOf(t).valueOf() <= e &&
                              e <= this.clone().endOf(t).valueOf()))
                );
            }),
            (G.isSameOrAfter = function (e, t) {
                return this.isSame(e, t) || this.isAfter(e, t);
            }),
            (G.isSameOrBefore = function (e, t) {
                return this.isSame(e, t) || this.isBefore(e, t);
            }),
            (G.isValid = function () {
                return f(this);
            }),
            (G.lang = Fe),
            (G.locale = Ht),
            (G.localeData = jt),
            (G.max = ie),
            (G.min = te),
            (G.parsingFlags = function () {
                return d({}, h(this));
            }),
            (G.set = function (e, t) {
                if ("object" == typeof e)
                    for (
                        var i = (function (e) {
                                var t,
                                    i = [];
                                for (t in e)
                                    s(e, t) &&
                                        i.push({ unit: t, priority: j[t] });
                                return (
                                    i.sort(function (e, t) {
                                        return e.priority - t.priority;
                                    }),
                                    i
                                );
                            })((e = H(e))),
                            n = i.length,
                            a = 0;
                        a < n;
                        a++
                    )
                        this[i[a].unit](e[i[a].unit]);
                else if (E(this[(e = F(e))])) return this[e](t);
                return this;
            }),
            (G.startOf = function (e) {
                var i, n;
                if (
                    void 0 === (e = F(e)) ||
                    "millisecond" === e ||
                    !this.isValid()
                )
                    return this;
                switch (((n = this._isUTC ? Vt : Bt), e)) {
                    case "year":
                        i = n(this.year(), 0, 1);
                        break;
                    case "quarter":
                        i = n(
                            this.year(),
                            this.month() - (this.month() % 3),
                            1
                        );
                        break;
                    case "month":
                        i = n(this.year(), this.month(), 1);
                        break;
                    case "week":
                        i = n(
                            this.year(),
                            this.month(),
                            this.date() - this.weekday()
                        );
                        break;
                    case "isoWeek":
                        i = n(
                            this.year(),
                            this.month(),
                            this.date() - (this.isoWeekday() - 1)
                        );
                        break;
                    case "day":
                    case "date":
                        i = n(this.year(), this.month(), this.date());
                        break;
                    case "hour":
                        (i = this._d.valueOf()),
                            (i -= Yt(
                                i + (this._isUTC ? 0 : 6e4 * this.utcOffset()),
                                36e5
                            ));
                        break;
                    case "minute":
                        (i = this._d.valueOf()), (i -= Yt(i, 6e4));
                        break;
                    case "second":
                        (i = this._d.valueOf()), (i -= Yt(i, 1e3));
                }
                return this._d.setTime(i), t.updateOffset(this, !0), this;
            }),
            (G.subtract = ze),
            (G.toArray = function () {
                var e = this;
                return [
                    e.year(),
                    e.month(),
                    e.date(),
                    e.hour(),
                    e.minute(),
                    e.second(),
                    e.millisecond(),
                ];
            }),
            (G.toObject = function () {
                var e = this;
                return {
                    years: e.year(),
                    months: e.month(),
                    date: e.date(),
                    hours: e.hours(),
                    minutes: e.minutes(),
                    seconds: e.seconds(),
                    milliseconds: e.milliseconds(),
                };
            }),
            (G.toDate = function () {
                return new Date(this.valueOf());
            }),
            (G.toISOString = function (e) {
                if (!this.isValid()) return null;
                var t = (e = !0 !== e) ? this.clone().utc() : this;
                return t.year() < 0 || 9999 < t.year()
                    ? I(
                          t,
                          e
                              ? "YYYYYY-MM-DD[T]HH:mm:ss.SSS[Z]"
                              : "YYYYYY-MM-DD[T]HH:mm:ss.SSSZ"
                      )
                    : E(Date.prototype.toISOString)
                    ? e
                        ? this.toDate().toISOString()
                        : new Date(this.valueOf() + 60 * this.utcOffset() * 1e3)
                              .toISOString()
                              .replace("Z", I(t, "Z"))
                    : I(
                          t,
                          e
                              ? "YYYY-MM-DD[T]HH:mm:ss.SSS[Z]"
                              : "YYYY-MM-DD[T]HH:mm:ss.SSSZ"
                      );
            }),
            (G.inspect = function () {
                if (!this.isValid())
                    return "moment.invalid(/* " + this._i + " */)";
                var e,
                    t = "moment",
                    i = "";
                return (
                    this.isLocal() ||
                        ((t =
                            0 === this.utcOffset()
                                ? "moment.utc"
                                : "moment.parseZone"),
                        (i = "Z")),
                    (t = "[" + t + '("]'),
                    (e =
                        0 <= this.year() && this.year() <= 9999
                            ? "YYYY"
                            : "YYYYYY"),
                    this.format(t + e + "-MM-DD[T]HH:mm:ss.SSS" + i + '[")]')
                );
            }),
            "undefined" != typeof Symbol &&
                null != Symbol.for &&
                (G[Symbol.for("nodejs.util.inspect.custom")] = function () {
                    return "Moment<" + this.format() + ">";
                }),
            (G.toJSON = function () {
                return this.isValid() ? this.toISOString() : null;
            }),
            (G.toString = function () {
                return this.clone()
                    .locale("en")
                    .format("ddd MMM DD YYYY HH:mm:ss [GMT]ZZ");
            }),
            (G.unix = function () {
                return Math.floor(this.valueOf() / 1e3);
            }),
            (G.valueOf = function () {
                return this._d.valueOf() - 6e4 * (this._offset || 0);
            }),
            (G.creationData = function () {
                return {
                    input: this._i,
                    format: this._f,
                    locale: this._locale,
                    isUTC: this._isUTC,
                    strict: this._strict,
                };
            }),
            (G.eraName = function () {
                for (
                    var e, t = this.localeData().eras(), i = 0, n = t.length;
                    i < n;
                    ++i
                ) {
                    if (
                        ((e = this.clone().startOf("day").valueOf()),
                        t[i].since <= e && e <= t[i].until)
                    )
                        return t[i].name;
                    if (t[i].until <= e && e <= t[i].since) return t[i].name;
                }
                return "";
            }),
            (G.eraNarrow = function () {
                for (
                    var e, t = this.localeData().eras(), i = 0, n = t.length;
                    i < n;
                    ++i
                ) {
                    if (
                        ((e = this.clone().startOf("day").valueOf()),
                        t[i].since <= e && e <= t[i].until)
                    )
                        return t[i].narrow;
                    if (t[i].until <= e && e <= t[i].since) return t[i].narrow;
                }
                return "";
            }),
            (G.eraAbbr = function () {
                for (
                    var e, t = this.localeData().eras(), i = 0, n = t.length;
                    i < n;
                    ++i
                ) {
                    if (
                        ((e = this.clone().startOf("day").valueOf()),
                        t[i].since <= e && e <= t[i].until)
                    )
                        return t[i].abbr;
                    if (t[i].until <= e && e <= t[i].since) return t[i].abbr;
                }
                return "";
            }),
            (G.eraYear = function () {
                for (
                    var e, i, n = this.localeData().eras(), s = 0, a = n.length;
                    s < a;
                    ++s
                )
                    if (
                        ((e = n[s].since <= n[s].until ? 1 : -1),
                        (i = this.clone().startOf("day").valueOf()),
                        (n[s].since <= i && i <= n[s].until) ||
                            (n[s].until <= i && i <= n[s].since))
                    )
                        return (
                            (this.year() - t(n[s].since).year()) * e +
                            n[s].offset
                        );
                return this.year();
            }),
            (G.year = Ae),
            (G.isLeapYear = function () {
                return Y(this.year());
            }),
            (G.weekYear = function (e) {
                return Gt.call(
                    this,
                    e,
                    this.week(),
                    this.weekday(),
                    this.localeData()._week.dow,
                    this.localeData()._week.doy
                );
            }),
            (G.isoWeekYear = function (e) {
                return Gt.call(
                    this,
                    e,
                    this.isoWeek(),
                    this.isoWeekday(),
                    1,
                    4
                );
            }),
            (G.quarter = G.quarters =
                function (e) {
                    return null == e
                        ? Math.ceil((this.month() + 1) / 3)
                        : this.month(3 * (e - 1) + (this.month() % 3));
                }),
            (G.month = ke),
            (G.daysInMonth = function () {
                return be(this.year(), this.month());
            }),
            (G.week = G.weeks =
                function (e) {
                    var t = this.localeData().week(this);
                    return null == e ? t : this.add(7 * (e - t), "d");
                }),
            (G.isoWeek = G.isoWeeks =
                function (e) {
                    var t = Ne(this, 1, 4).week;
                    return null == e ? t : this.add(7 * (e - t), "d");
                }),
            (G.weeksInYear = function () {
                var e = this.localeData()._week;
                return Ie(this.year(), e.dow, e.doy);
            }),
            (G.weeksInWeekYear = function () {
                var e = this.localeData()._week;
                return Ie(this.weekYear(), e.dow, e.doy);
            }),
            (G.isoWeeksInYear = function () {
                return Ie(this.year(), 1, 4);
            }),
            (G.isoWeeksInISOWeekYear = function () {
                return Ie(this.isoWeekYear(), 1, 4);
            }),
            (G.date = se),
            (G.day = G.days =
                function (e) {
                    if (!this.isValid()) return null != e ? this : NaN;
                    var t,
                        i,
                        n = this._isUTC
                            ? this._d.getUTCDay()
                            : this._d.getDay();
                    return null != e
                        ? ((t = e),
                          (i = this.localeData()),
                          (e =
                              "string" != typeof t
                                  ? t
                                  : isNaN(t)
                                  ? "number" == typeof (t = i.weekdaysParse(t))
                                      ? t
                                      : null
                                  : parseInt(t, 10)),
                          this.add(e - n, "d"))
                        : n;
                }),
            (G.weekday = function (e) {
                if (!this.isValid()) return null != e ? this : NaN;
                var t = (this.day() + 7 - this.localeData()._week.dow) % 7;
                return null == e ? t : this.add(e - t, "d");
            }),
            (G.isoWeekday = function (e) {
                return this.isValid()
                    ? null != e
                        ? ((t = e),
                          (i = this.localeData()),
                          (i =
                              "string" == typeof t
                                  ? i.weekdaysParse(t) % 7 || 7
                                  : isNaN(t)
                                  ? null
                                  : t),
                          this.day(this.day() % 7 ? i : i - 7))
                        : this.day() || 7
                    : null != e
                    ? this
                    : NaN;
                var t, i;
            }),
            (G.dayOfYear = function (e) {
                var t =
                    Math.round(
                        (this.clone().startOf("day") -
                            this.clone().startOf("year")) /
                            864e5
                    ) + 1;
                return null == e ? t : this.add(e - t, "d");
            }),
            (G.hour = G.hours = de),
            (G.minute = G.minutes = Z),
            (G.second = G.seconds = ae),
            (G.millisecond = G.milliseconds = J),
            (G.utcOffset = function (e, i, n) {
                var s,
                    a = this._offset || 0;
                if (!this.isValid()) return null != e ? this : NaN;
                if (null == e) return this._isUTC ? a : Ct(this);
                if ("string" == typeof e) {
                    if (null === (e = kt(ue, e))) return this;
                } else Math.abs(e) < 16 && !n && (e *= 60);
                return (
                    !this._isUTC && i && (s = Ct(this)),
                    (this._offset = e),
                    (this._isUTC = !0),
                    null != s && this.add(s, "m"),
                    a !== e &&
                        (!i || this._changeInProgress
                            ? Rt(this, Dt(e - a, "m"), 1, !1)
                            : this._changeInProgress ||
                              ((this._changeInProgress = !0),
                              t.updateOffset(this, !0),
                              (this._changeInProgress = null))),
                    this
                );
            }),
            (G.utc = function (e) {
                return this.utcOffset(0, e);
            }),
            (G.local = function (e) {
                return (
                    this._isUTC &&
                        (this.utcOffset(0, e),
                        (this._isUTC = !1),
                        e && this.subtract(Ct(this), "m")),
                    this
                );
            }),
            (G.parseZone = function () {
                var e;
                return (
                    null != this._tzm
                        ? this.utcOffset(this._tzm, !1, !0)
                        : "string" == typeof this._i &&
                          (null != (e = kt(le, this._i))
                              ? this.utcOffset(e)
                              : this.utcOffset(0, !0)),
                    this
                );
            }),
            (G.hasAlignedHourOffset = function (e) {
                return (
                    !!this.isValid() &&
                    ((e = e ? yt(e).utcOffset() : 0),
                    (this.utcOffset() - e) % 60 == 0)
                );
            }),
            (G.isDST = function () {
                return (
                    this.utcOffset() > this.clone().month(0).utcOffset() ||
                    this.utcOffset() > this.clone().month(5).utcOffset()
                );
            }),
            (G.isLocal = function () {
                return !!this.isValid() && !this._isUTC;
            }),
            (G.isUtcOffset = function () {
                return !!this.isValid() && this._isUTC;
            }),
            (G.isUtc = At),
            (G.isUTC = At),
            (G.zoneAbbr = function () {
                return this._isUTC ? "UTC" : "";
            }),
            (G.zoneName = function () {
                return this._isUTC ? "Coordinated Universal Time" : "";
            }),
            (G.dates = w(
                "dates accessor is deprecated. Use date instead.",
                se
            )),
            (G.months = w(
                "months accessor is deprecated. Use month instead",
                ke
            )),
            (G.years = w("years accessor is deprecated. Use year instead", Ae)),
            (G.zone = w(
                "moment().zone is deprecated, use moment().utcOffset instead. http://momentjs.com/guides/#/warnings/zone/",
                function (e, t) {
                    return null != e
                        ? (this.utcOffset(
                              (e = "string" != typeof e ? -e : e),
                              t
                          ),
                          this)
                        : -this.utcOffset();
                }
            )),
            (G.isDSTShifted = w(
                "isDSTShifted is deprecated. See http://momentjs.com/guides/#/warnings/dst-shifted/ for more information",
                function () {
                    if (!r(this._isDSTShifted)) return this._isDSTShifted;
                    var e,
                        t = {};
                    return (
                        y(t, this),
                        (t = gt(t))._a
                            ? ((e = (t._isUTC ? c : yt)(t._a)),
                              (this._isDSTShifted =
                                  this.isValid() &&
                                  0 <
                                      (function (e, t, i) {
                                          for (
                                              var n = Math.min(
                                                      e.length,
                                                      t.length
                                                  ),
                                                  s = Math.abs(
                                                      e.length - t.length
                                                  ),
                                                  a = 0,
                                                  r = 0;
                                              r < n;
                                              r++
                                          )
                                              V(e[r]) !== V(t[r]) && a++;
                                          return a + s;
                                      })(t._a, e.toArray())))
                            : (this._isDSTShifted = !1),
                        this._isDSTShifted
                    );
                }
            )),
            ((K = T.prototype).calendar = function (e, t, i) {
                return E((e = this._calendar[e] || this._calendar.sameElse))
                    ? e.call(t, i)
                    : e;
            }),
            (K.longDateFormat = function (e) {
                var t = this._longDateFormat[e],
                    i = this._longDateFormat[e.toUpperCase()];
                return t || !i
                    ? t
                    : ((this._longDateFormat[e] = i
                          .match(P)
                          .map(function (e) {
                              return "MMMM" === e ||
                                  "MM" === e ||
                                  "DD" === e ||
                                  "dddd" === e
                                  ? e.slice(1)
                                  : e;
                          })
                          .join("")),
                      this._longDateFormat[e]);
            }),
            (K.invalidDate = function () {
                return this._invalidDate;
            }),
            (K.ordinal = function (e) {
                return this._ordinal.replace("%d", e);
            }),
            (K.preparse = Zt),
            (K.postformat = Zt),
            (K.relativeTime = function (e, t, i, n) {
                var s = this._relativeTime[i];
                return E(s) ? s(e, t, i, n) : s.replace(/%d/i, e);
            }),
            (K.pastFuture = function (e, t) {
                return E((e = this._relativeTime[0 < e ? "future" : "past"]))
                    ? e(t)
                    : e.replace(/%s/i, t);
            }),
            (K.set = function (e) {
                var t, i;
                for (i in e)
                    s(e, i) &&
                        (E((t = e[i])) ? (this[i] = t) : (this["_" + i] = t));
                (this._config = e),
                    (this._dayOfMonthOrdinalParseLenient = new RegExp(
                        (this._dayOfMonthOrdinalParse.source ||
                            this._ordinalParse.source) +
                            "|" +
                            /\d{1,2}/.source
                    ));
            }),
            (K.eras = function (e, i) {
                for (
                    var n,
                        s = this._eras || tt("en")._eras,
                        a = 0,
                        r = s.length;
                    a < r;
                    ++a
                ) {
                    if ("string" == typeof s[a].since)
                        (n = t(s[a].since).startOf("day")),
                            (s[a].since = n.valueOf());
                    switch (typeof s[a].until) {
                        case "undefined":
                            s[a].until = 1 / 0;
                            break;
                        case "string":
                            (n = t(s[a].until).startOf("day").valueOf()),
                                (s[a].until = n.valueOf());
                    }
                }
                return s;
            }),
            (K.erasParse = function (e, t, i) {
                var n,
                    s,
                    a,
                    r,
                    o,
                    l = this.eras();
                for (e = e.toUpperCase(), n = 0, s = l.length; n < s; ++n)
                    if (
                        ((a = l[n].name.toUpperCase()),
                        (r = l[n].abbr.toUpperCase()),
                        (o = l[n].narrow.toUpperCase()),
                        i)
                    )
                        switch (t) {
                            case "N":
                            case "NN":
                            case "NNN":
                                if (r === e) return l[n];
                                break;
                            case "NNNN":
                                if (a === e) return l[n];
                                break;
                            case "NNNNN":
                                if (o === e) return l[n];
                        }
                    else if (0 <= [a, r, o].indexOf(e)) return l[n];
            }),
            (K.erasConvertYear = function (e, i) {
                var n = e.since <= e.until ? 1 : -1;
                return void 0 === i
                    ? t(e.since).year()
                    : t(e.since).year() + (i - e.offset) * n;
            }),
            (K.erasAbbrRegex = function (e) {
                return (
                    s(this, "_erasAbbrRegex") || Ut.call(this),
                    e ? this._erasAbbrRegex : this._erasRegex
                );
            }),
            (K.erasNameRegex = function (e) {
                return (
                    s(this, "_erasNameRegex") || Ut.call(this),
                    e ? this._erasNameRegex : this._erasRegex
                );
            }),
            (K.erasNarrowRegex = function (e) {
                return (
                    s(this, "_erasNarrowRegex") || Ut.call(this),
                    e ? this._erasNarrowRegex : this._erasRegex
                );
            }),
            (K.months = function (e, t) {
                return e
                    ? (i(this._months)
                          ? this._months
                          : this._months[
                                (this._months.isFormat || we).test(t)
                                    ? "format"
                                    : "standalone"
                            ])[e.month()]
                    : i(this._months)
                    ? this._months
                    : this._months.standalone;
            }),
            (K.monthsShort = function (e, t) {
                return e
                    ? (i(this._monthsShort)
                          ? this._monthsShort
                          : this._monthsShort[
                                we.test(t) ? "format" : "standalone"
                            ])[e.month()]
                    : i(this._monthsShort)
                    ? this._monthsShort
                    : this._monthsShort.standalone;
            }),
            (K.monthsParse = function (e, t, i) {
                var n, s;
                if (this._monthsParseExact)
                    return function (e, t, i) {
                        var n, s, a;
                        e = e.toLocaleLowerCase();
                        if (!this._monthsParse)
                            for (
                                this._monthsParse = [],
                                    this._longMonthsParse = [],
                                    this._shortMonthsParse = [],
                                    n = 0;
                                n < 12;
                                ++n
                            )
                                (a = c([2e3, n])),
                                    (this._shortMonthsParse[n] =
                                        this.monthsShort(
                                            a,
                                            ""
                                        ).toLocaleLowerCase()),
                                    (this._longMonthsParse[n] = this.months(
                                        a,
                                        ""
                                    ).toLocaleLowerCase());
                        return i
                            ? "MMM" === t
                                ? -1 !==
                                  (s = ye.call(this._shortMonthsParse, e))
                                    ? s
                                    : null
                                : -1 !== (s = ye.call(this._longMonthsParse, e))
                                ? s
                                : null
                            : "MMM" === t
                            ? -1 !== (s = ye.call(this._shortMonthsParse, e)) ||
                              -1 !== (s = ye.call(this._longMonthsParse, e))
                                ? s
                                : null
                            : -1 !== (s = ye.call(this._longMonthsParse, e)) ||
                              -1 !== (s = ye.call(this._shortMonthsParse, e))
                            ? s
                            : null;
                    }.call(this, e, t, i);
                for (
                    this._monthsParse ||
                        ((this._monthsParse = []),
                        (this._longMonthsParse = []),
                        (this._shortMonthsParse = [])),
                        n = 0;
                    n < 12;
                    n++
                ) {
                    if (
                        ((s = c([2e3, n])),
                        i &&
                            !this._longMonthsParse[n] &&
                            ((this._longMonthsParse[n] = new RegExp(
                                "^" + this.months(s, "").replace(".", "") + "$",
                                "i"
                            )),
                            (this._shortMonthsParse[n] = new RegExp(
                                "^" +
                                    this.monthsShort(s, "").replace(".", "") +
                                    "$",
                                "i"
                            ))),
                        i ||
                            this._monthsParse[n] ||
                            ((s =
                                "^" +
                                this.months(s, "") +
                                "|^" +
                                this.monthsShort(s, "")),
                            (this._monthsParse[n] = new RegExp(
                                s.replace(".", ""),
                                "i"
                            ))),
                        i && "MMMM" === t && this._longMonthsParse[n].test(e))
                    )
                        return n;
                    if (i && "MMM" === t && this._shortMonthsParse[n].test(e))
                        return n;
                    if (!i && this._monthsParse[n].test(e)) return n;
                }
            }),
            (K.monthsRegex = function (e) {
                return this._monthsParseExact
                    ? (s(this, "_monthsRegex") || Te.call(this),
                      e ? this._monthsStrictRegex : this._monthsRegex)
                    : (s(this, "_monthsRegex") || (this._monthsRegex = Me),
                      this._monthsStrictRegex && e
                          ? this._monthsStrictRegex
                          : this._monthsRegex);
            }),
            (K.monthsShortRegex = function (e) {
                return this._monthsParseExact
                    ? (s(this, "_monthsRegex") || Te.call(this),
                      e ? this._monthsShortStrictRegex : this._monthsShortRegex)
                    : (s(this, "_monthsShortRegex") ||
                          (this._monthsShortRegex = Se),
                      this._monthsShortStrictRegex && e
                          ? this._monthsShortStrictRegex
                          : this._monthsShortRegex);
            }),
            (K.week = function (e) {
                return Ne(e, this._week.dow, this._week.doy).week;
            }),
            (K.firstDayOfYear = function () {
                return this._week.doy;
            }),
            (K.firstDayOfWeek = function () {
                return this._week.dow;
            }),
            (K.weekdays = function (e, t) {
                return (
                    (t = i(this._weekdays)
                        ? this._weekdays
                        : this._weekdays[
                              e && !0 !== e && this._weekdays.isFormat.test(t)
                                  ? "format"
                                  : "standalone"
                          ]),
                    !0 === e ? Re(t, this._week.dow) : e ? t[e.day()] : t
                );
            }),
            (K.weekdaysMin = function (e) {
                return !0 === e
                    ? Re(this._weekdaysMin, this._week.dow)
                    : e
                    ? this._weekdaysMin[e.day()]
                    : this._weekdaysMin;
            }),
            (K.weekdaysShort = function (e) {
                return !0 === e
                    ? Re(this._weekdaysShort, this._week.dow)
                    : e
                    ? this._weekdaysShort[e.day()]
                    : this._weekdaysShort;
            }),
            (K.weekdaysParse = function (e, t, i) {
                var n, s;
                if (this._weekdaysParseExact)
                    return function (e, t, i) {
                        var n, s, a;
                        e = e.toLocaleLowerCase();
                        if (!this._weekdaysParse)
                            for (
                                this._weekdaysParse = [],
                                    this._shortWeekdaysParse = [],
                                    this._minWeekdaysParse = [],
                                    n = 0;
                                n < 7;
                                ++n
                            )
                                (a = c([2e3, 1]).day(n)),
                                    (this._minWeekdaysParse[n] =
                                        this.weekdaysMin(
                                            a,
                                            ""
                                        ).toLocaleLowerCase()),
                                    (this._shortWeekdaysParse[n] =
                                        this.weekdaysShort(
                                            a,
                                            ""
                                        ).toLocaleLowerCase()),
                                    (this._weekdaysParse[n] = this.weekdays(
                                        a,
                                        ""
                                    ).toLocaleLowerCase());
                        return i
                            ? "dddd" === t
                                ? -1 !== (s = ye.call(this._weekdaysParse, e))
                                    ? s
                                    : null
                                : "ddd" === t
                                ? -1 !==
                                  (s = ye.call(this._shortWeekdaysParse, e))
                                    ? s
                                    : null
                                : -1 !==
                                  (s = ye.call(this._minWeekdaysParse, e))
                                ? s
                                : null
                            : "dddd" === t
                            ? -1 !== (s = ye.call(this._weekdaysParse, e)) ||
                              -1 !==
                                  (s = ye.call(this._shortWeekdaysParse, e)) ||
                              -1 !== (s = ye.call(this._minWeekdaysParse, e))
                                ? s
                                : null
                            : "ddd" === t
                            ? -1 !==
                                  (s = ye.call(this._shortWeekdaysParse, e)) ||
                              -1 !== (s = ye.call(this._weekdaysParse, e)) ||
                              -1 !== (s = ye.call(this._minWeekdaysParse, e))
                                ? s
                                : null
                            : -1 !== (s = ye.call(this._minWeekdaysParse, e)) ||
                              -1 !== (s = ye.call(this._weekdaysParse, e)) ||
                              -1 !== (s = ye.call(this._shortWeekdaysParse, e))
                            ? s
                            : null;
                    }.call(this, e, t, i);
                for (
                    this._weekdaysParse ||
                        ((this._weekdaysParse = []),
                        (this._minWeekdaysParse = []),
                        (this._shortWeekdaysParse = []),
                        (this._fullWeekdaysParse = [])),
                        n = 0;
                    n < 7;
                    n++
                ) {
                    if (
                        ((s = c([2e3, 1]).day(n)),
                        i &&
                            !this._fullWeekdaysParse[n] &&
                            ((this._fullWeekdaysParse[n] = new RegExp(
                                "^" +
                                    this.weekdays(s, "").replace(".", "\\.?") +
                                    "$",
                                "i"
                            )),
                            (this._shortWeekdaysParse[n] = new RegExp(
                                "^" +
                                    this.weekdaysShort(s, "").replace(
                                        ".",
                                        "\\.?"
                                    ) +
                                    "$",
                                "i"
                            )),
                            (this._minWeekdaysParse[n] = new RegExp(
                                "^" +
                                    this.weekdaysMin(s, "").replace(
                                        ".",
                                        "\\.?"
                                    ) +
                                    "$",
                                "i"
                            ))),
                        this._weekdaysParse[n] ||
                            ((s =
                                "^" +
                                this.weekdays(s, "") +
                                "|^" +
                                this.weekdaysShort(s, "") +
                                "|^" +
                                this.weekdaysMin(s, "")),
                            (this._weekdaysParse[n] = new RegExp(
                                s.replace(".", ""),
                                "i"
                            ))),
                        i && "dddd" === t && this._fullWeekdaysParse[n].test(e))
                    )
                        return n;
                    if (i && "ddd" === t && this._shortWeekdaysParse[n].test(e))
                        return n;
                    if (i && "dd" === t && this._minWeekdaysParse[n].test(e))
                        return n;
                    if (!i && this._weekdaysParse[n].test(e)) return n;
                }
            }),
            (K.weekdaysRegex = function (e) {
                return this._weekdaysParseExact
                    ? (s(this, "_weekdaysRegex") || Ye.call(this),
                      e ? this._weekdaysStrictRegex : this._weekdaysRegex)
                    : (s(this, "_weekdaysRegex") || (this._weekdaysRegex = He),
                      this._weekdaysStrictRegex && e
                          ? this._weekdaysStrictRegex
                          : this._weekdaysRegex);
            }),
            (K.weekdaysShortRegex = function (e) {
                return this._weekdaysParseExact
                    ? (s(this, "_weekdaysRegex") || Ye.call(this),
                      e
                          ? this._weekdaysShortStrictRegex
                          : this._weekdaysShortRegex)
                    : (s(this, "_weekdaysShortRegex") ||
                          (this._weekdaysShortRegex = je),
                      this._weekdaysShortStrictRegex && e
                          ? this._weekdaysShortStrictRegex
                          : this._weekdaysShortRegex);
            }),
            (K.weekdaysMinRegex = function (e) {
                return this._weekdaysParseExact
                    ? (s(this, "_weekdaysRegex") || Ye.call(this),
                      e ? this._weekdaysMinStrictRegex : this._weekdaysMinRegex)
                    : (s(this, "_weekdaysMinRegex") ||
                          (this._weekdaysMinRegex = We),
                      this._weekdaysMinStrictRegex && e
                          ? this._weekdaysMinStrictRegex
                          : this._weekdaysMinRegex);
            }),
            (K.isPM = function (e) {
                return "p" === (e + "").toLowerCase().charAt(0);
            }),
            (K.meridiem = function (e, t, i) {
                return 11 < e ? (i ? "pm" : "PM") : i ? "am" : "AM";
            }),
            Je("en", {
                eras: [
                    {
                        since: "0001-01-01",
                        until: 1 / 0,
                        offset: 1,
                        name: "Anno Domini",
                        narrow: "AD",
                        abbr: "AD",
                    },
                    {
                        since: "0000-12-31",
                        until: -1 / 0,
                        offset: 1,
                        name: "Before Christ",
                        narrow: "BC",
                        abbr: "BC",
                    },
                ],
                dayOfMonthOrdinalParse: /\d{1,2}(th|st|nd|rd)/,
                ordinal: function (e) {
                    var t = e % 10;
                    return (
                        e +
                        (1 === V((e % 100) / 10)
                            ? "th"
                            : 1 == t
                            ? "st"
                            : 2 == t
                            ? "nd"
                            : 3 == t
                            ? "rd"
                            : "th")
                    );
                },
            }),
            (t.lang = w(
                "moment.lang is deprecated. Use moment.locale instead.",
                Je
            )),
            (t.langData = w(
                "moment.langData is deprecated. Use moment.localeData instead.",
                tt
            ));
        var ii = Math.abs;
        function ni(e, t, i, n) {
            return (
                (t = Dt(t, i)),
                (e._milliseconds += n * t._milliseconds),
                (e._days += n * t._days),
                (e._months += n * t._months),
                e._bubble()
            );
        }
        function si(e) {
            return e < 0 ? Math.floor(e) : Math.ceil(e);
        }
        function ai(e) {
            return (4800 * e) / 146097;
        }
        function ri(e) {
            return (146097 * e) / 4800;
        }
        function oi(e) {
            return function () {
                return this.as(e);
            };
        }
        function li(e) {
            return function () {
                return this.isValid() ? this._data[e] : NaN;
            };
        }
        (ne = oi("ms")),
            (Q = oi("s")),
            (_e = oi("m")),
            (ie = oi("h")),
            (te = oi("d")),
            (ze = oi("w")),
            (de = oi("M")),
            (Z = oi("Q")),
            (ae = oi("y"));
        (J = li("milliseconds")),
            (se = li("seconds")),
            (Ae = li("minutes")),
            (K = li("hours"));
        var ui = li("days"),
            di = li("months"),
            ci = li("years"),
            hi = Math.round,
            fi = { ss: 44, s: 45, m: 45, h: 22, d: 26, w: null, M: 11 };
        var pi = Math.abs;
        function mi(e) {
            return (0 < e) - (e < 0) || +e;
        }
        function gi() {
            if (!this.isValid()) return this.localeData().invalidDate();
            var e,
                t,
                i,
                n,
                s,
                a,
                r,
                o = pi(this._milliseconds) / 1e3,
                l = pi(this._days),
                u = pi(this._months),
                d = this.asSeconds();
            return d
                ? ((e = B(o / 60)),
                  (t = B(e / 60)),
                  (o %= 60),
                  (e %= 60),
                  (i = B(u / 12)),
                  (u %= 12),
                  (n = o ? o.toFixed(3).replace(/\.?0+$/, "") : ""),
                  (s = mi(this._months) !== mi(d) ? "-" : ""),
                  (a = mi(this._days) !== mi(d) ? "-" : ""),
                  (r = mi(this._milliseconds) !== mi(d) ? "-" : ""),
                  (d < 0 ? "-" : "") +
                      "P" +
                      (i ? s + i + "Y" : "") +
                      (u ? s + u + "M" : "") +
                      (l ? a + l + "D" : "") +
                      (t || e || o ? "T" : "") +
                      (t ? r + t + "H" : "") +
                      (e ? r + e + "M" : "") +
                      (o ? r + n + "S" : ""))
                : "P0D";
        }
        var vi = xt.prototype;
        return (
            (vi.isValid = function () {
                return this._isValid;
            }),
            (vi.abs = function () {
                var e = this._data;
                return (
                    (this._milliseconds = ii(this._milliseconds)),
                    (this._days = ii(this._days)),
                    (this._months = ii(this._months)),
                    (e.milliseconds = ii(e.milliseconds)),
                    (e.seconds = ii(e.seconds)),
                    (e.minutes = ii(e.minutes)),
                    (e.hours = ii(e.hours)),
                    (e.months = ii(e.months)),
                    (e.years = ii(e.years)),
                    this
                );
            }),
            (vi.add = function (e, t) {
                return ni(this, e, t, 1);
            }),
            (vi.subtract = function (e, t) {
                return ni(this, e, t, -1);
            }),
            (vi.as = function (e) {
                if (!this.isValid()) return NaN;
                var t,
                    i,
                    n = this._milliseconds;
                if ("month" === (e = F(e)) || "quarter" === e || "year" === e)
                    switch (
                        ((t = this._days + n / 864e5),
                        (i = this._months + ai(t)),
                        e)
                    ) {
                        case "month":
                            return i;
                        case "quarter":
                            return i / 3;
                        case "year":
                            return i / 12;
                    }
                else
                    switch (
                        ((t = this._days + Math.round(ri(this._months))), e)
                    ) {
                        case "week":
                            return t / 7 + n / 6048e5;
                        case "day":
                            return t + n / 864e5;
                        case "hour":
                            return 24 * t + n / 36e5;
                        case "minute":
                            return 1440 * t + n / 6e4;
                        case "second":
                            return 86400 * t + n / 1e3;
                        case "millisecond":
                            return Math.floor(864e5 * t) + n;
                        default:
                            throw new Error("Unknown unit " + e);
                    }
            }),
            (vi.asMilliseconds = ne),
            (vi.asSeconds = Q),
            (vi.asMinutes = _e),
            (vi.asHours = ie),
            (vi.asDays = te),
            (vi.asWeeks = ze),
            (vi.asMonths = de),
            (vi.asQuarters = Z),
            (vi.asYears = ae),
            (vi.valueOf = function () {
                return this.isValid()
                    ? this._milliseconds +
                          864e5 * this._days +
                          (this._months % 12) * 2592e6 +
                          31536e6 * V(this._months / 12)
                    : NaN;
            }),
            (vi._bubble = function () {
                var e = this._milliseconds,
                    t = this._days,
                    i = this._months,
                    n = this._data;
                return (
                    (0 <= e && 0 <= t && 0 <= i) ||
                        (e <= 0 && t <= 0 && i <= 0) ||
                        ((e += 864e5 * si(ri(i) + t)), (i = t = 0)),
                    (n.milliseconds = e % 1e3),
                    (e = B(e / 1e3)),
                    (n.seconds = e % 60),
                    (e = B(e / 60)),
                    (n.minutes = e % 60),
                    (e = B(e / 60)),
                    (n.hours = e % 24),
                    (t += B(e / 24)),
                    (i += e = B(ai(t))),
                    (t -= si(ri(e))),
                    (e = B(i / 12)),
                    (i %= 12),
                    (n.days = t),
                    (n.months = i),
                    (n.years = e),
                    this
                );
            }),
            (vi.clone = function () {
                return Dt(this);
            }),
            (vi.get = function (e) {
                return (e = F(e)), this.isValid() ? this[e + "s"]() : NaN;
            }),
            (vi.milliseconds = J),
            (vi.seconds = se),
            (vi.minutes = Ae),
            (vi.hours = K),
            (vi.days = ui),
            (vi.weeks = function () {
                return B(this.days() / 7);
            }),
            (vi.months = di),
            (vi.years = ci),
            (vi.humanize = function (e, t) {
                if (!this.isValid()) return this.localeData().invalidDate();
                var i = !1,
                    n = fi;
                return (
                    "object" == typeof e && ((t = e), (e = !1)),
                    "boolean" == typeof e && (i = e),
                    "object" == typeof t &&
                        ((n = Object.assign({}, fi, t)),
                        null != t.s && null == t.ss && (n.ss = t.s - 1)),
                    (t = (function (e, t, i, n) {
                        var s = Dt(e).abs(),
                            a = hi(s.as("s")),
                            r = hi(s.as("m")),
                            o = hi(s.as("h")),
                            l = hi(s.as("d")),
                            u = hi(s.as("M")),
                            d = hi(s.as("w"));
                        return (
                            (s = hi(s.as("y"))),
                            (a =
                                (a <= i.ss ? ["s", a] : a < i.s && ["ss", a]) ||
                                (r <= 1 && ["m"]) ||
                                (r < i.m && ["mm", r]) ||
                                (o <= 1 && ["h"]) ||
                                (o < i.h && ["hh", o]) ||
                                (l <= 1 && ["d"]) ||
                                (l < i.d && ["dd", l])),
                            ((a = (a =
                                null != i.w
                                    ? a ||
                                      (d <= 1 && ["w"]) ||
                                      (d < i.w && ["ww", d])
                                    : a) ||
                                (u <= 1 && ["M"]) ||
                                (u < i.M && ["MM", u]) ||
                                (s <= 1 && ["y"]) || ["yy", s])[2] = t),
                            (a[3] = 0 < +e),
                            (a[4] = n),
                            function (e, t, i, n, s) {
                                return s.relativeTime(t || 1, !!i, e, n);
                            }.apply(null, a)
                        );
                    })(this, !i, n, (e = this.localeData()))),
                    i && (t = e.pastFuture(+this, t)),
                    e.postformat(t)
                );
            }),
            (vi.toISOString = gi),
            (vi.toString = gi),
            (vi.toJSON = gi),
            (vi.locale = Ht),
            (vi.localeData = jt),
            (vi.toIsoString = w(
                "toIsoString() is deprecated. Please use toISOString() instead (notice the capitals)",
                gi
            )),
            (vi.lang = Fe),
            N("X", 0, 0, "unix"),
            N("x", 0, 0, "valueOf"),
            ce("x", oe),
            ce("X", /[+-]?\d+(\.\d{1,3})?/),
            ge("X", function (e, t, i) {
                i._d = new Date(1e3 * parseFloat(e));
            }),
            ge("x", function (e, t, i) {
                i._d = new Date(V(e));
            }),
            (t.version = "2.29.4"),
            (e = yt),
            (t.fn = G),
            (t.min = function () {
                return bt("isBefore", [].slice.call(arguments, 0));
            }),
            (t.max = function () {
                return bt("isAfter", [].slice.call(arguments, 0));
            }),
            (t.now = function () {
                return Date.now ? Date.now() : +new Date();
            }),
            (t.utc = c),
            (t.unix = function (e) {
                return yt(1e3 * e);
            }),
            (t.months = function (e, t) {
                return ei(e, t, "months");
            }),
            (t.isDate = l),
            (t.locale = Je),
            (t.invalid = p),
            (t.duration = Dt),
            (t.isMoment = _),
            (t.weekdays = function (e, t, i) {
                return ti(e, t, i, "weekdays");
            }),
            (t.parseZone = function () {
                return yt.apply(null, arguments).parseZone();
            }),
            (t.localeData = tt),
            (t.isDuration = wt),
            (t.monthsShort = function (e, t) {
                return ei(e, t, "monthsShort");
            }),
            (t.weekdaysMin = function (e, t, i) {
                return ti(e, t, i, "weekdaysMin");
            }),
            (t.defineLocale = et),
            (t.updateLocale = function (e, t) {
                var i, n;
                return (
                    null != t
                        ? ((n = Xe),
                          null != Ge[e] && null != Ge[e].parentLocale
                              ? Ge[e].set(k(Ge[e]._config, t))
                              : ((t = k(
                                    (n = null != (i = Ze(e)) ? i._config : n),
                                    t
                                )),
                                null == i && (t.abbr = e),
                                ((n = new T(t)).parentLocale = Ge[e]),
                                (Ge[e] = n)),
                          Je(e))
                        : null != Ge[e] &&
                          (null != Ge[e].parentLocale
                              ? ((Ge[e] = Ge[e].parentLocale),
                                e === Je() && Je(e))
                              : null != Ge[e] && delete Ge[e]),
                    Ge[e]
                );
            }),
            (t.locales = function () {
                return C(Ge);
            }),
            (t.weekdaysShort = function (e, t, i) {
                return ti(e, t, i, "weekdaysShort");
            }),
            (t.normalizeUnits = F),
            (t.relativeTimeRounding = function (e) {
                return void 0 === e
                    ? hi
                    : "function" == typeof e && ((hi = e), !0);
            }),
            (t.relativeTimeThreshold = function (e, t) {
                return (
                    void 0 !== fi[e] &&
                    (void 0 === t
                        ? fi[e]
                        : ((fi[e] = t), "s" === e && (fi.ss = t - 1), !0))
                );
            }),
            (t.calendarFormat = function (e, t) {
                return (e = e.diff(t, "days", !0)) < -6
                    ? "sameElse"
                    : e < -1
                    ? "lastWeek"
                    : e < 0
                    ? "lastDay"
                    : e < 1
                    ? "sameDay"
                    : e < 2
                    ? "nextDay"
                    : e < 7
                    ? "nextWeek"
                    : "sameElse";
            }),
            (t.prototype = G),
            (t.HTML5_FMT = {
                DATETIME_LOCAL: "YYYY-MM-DDTHH:mm",
                DATETIME_LOCAL_SECONDS: "YYYY-MM-DDTHH:mm:ss",
                DATETIME_LOCAL_MS: "YYYY-MM-DDTHH:mm:ss.SSS",
                DATE: "YYYY-MM-DD",
                TIME: "HH:mm",
                TIME_SECONDS: "HH:mm:ss",
                TIME_MS: "HH:mm:ss.SSS",
                WEEK: "GGGG-[W]WW",
                MONTH: "YYYY-MM",
            }),
            t
        );
    });
