(function(e) {
    "function" == typeof define && define.amd ? define(["jquery", "moment"], e) : e(jQuery, moment)
})(function(e, t) {
    function a(e, t, a, n) {
        return t ? "kelios sekundės" : n ? "kelių sekundžių" : "kelias sekundes"
    }
    function n(e, t, a, n) {
        return t ? i(a)[0] : n ? i(a)[1] : i(a)[2]
    }
    function r(e) {
        return 0 === e % 10 || e > 10 && 20 > e
    }
    function i(e) {
        return d[e].split("_")
    }
    function o(e, t, a, o) {
        var s = e + " ";
        return 1 === e ? s + n(e, t, a[0], o) : t ? s + (r(e) ? i(a)[1] : i(a)[0]) : o ? s + i(a)[1] : s + (r(e) ? i(a)[1] : i(a)[2])
    }
    function s(e, t) {
        var a = -1 === t.indexOf("dddd LT"), n = u[e.weekday()];
        return a ? n : n.substring(0, n.length - 2) + "į"
    }
    var d = {m: "minutė_minutės_minutę", mm: "minutės_minučių_minutes", h: "valanda_valandos_valandą", hh: "valandos_valandų_valandas", d: "diena_dienos_dieną", dd: "dienos_dienų_dienas", M: "mėnuo_mėnesio_mėnesį", MM: "mėnesiai_mėnesių_mėnesius", y: "metai_metų_metus", yy: "metai_metų_metus"}, u = "pirmadienis_antradienis_trečiadienis_ketvirtadienis_penktadienis_šeštadienis_sekmadienis".split("_");
    t.lang("lt", {months: "sausio_vasario_kovo_balandžio_gegužės_biržėlio_liepos_rugpjūčio_rugsėjo_spalio_lapkričio_gruodžio".split("_"), monthsShort: "sau_vas_kov_bal_geg_bir_lie_rgp_rgs_spa_lap_grd".split("_"), weekdays: s, weekdaysShort: "Sek_Pir_Ant_Tre_Ket_Pen_Šeš".split("_"), weekdaysMin: "S_P_A_T_K_Pn_Š".split("_"), longDateFormat: {LT: "HH:mm", L: "YYYY-MM-DD", LL: "YYYY [m.] MMMM D [d.]", LLL: "YYYY [m.] MMMM D [d.], LT [val.]", LLLL: "YYYY [m.] MMMM D [d.], dddd, LT [val.]", l: "YYYY-MM-DD", ll: "YYYY [m.] MMMM D [d.]", lll: "YYYY [m.] MMMM D [d.], LT [val.]", llll: "YYYY [m.] MMMM D [d.], ddd, LT [val.]"}, calendar: {sameDay: "[Šiandien] LT", nextDay: "[Rytoj] LT", nextWeek: "dddd LT", lastDay: "[Vakar] LT", lastWeek: "[Praėjusį] dddd LT", sameElse: "L"}, relativeTime: {future: "po %s", past: "prieš %s", s: a, m: n, mm: o, h: n, hh: o, d: n, dd: o, M: n, MM: o, y: n, yy: o}, ordinal: function(e) {
            return e + "-oji"
        }, week: {dow: 1, doy: 4}}), e.fullCalendar.datepickerLang("lt", "lt", {closeText: "Uždaryti", prevText: "&#x3C;Atgal", nextText: "Pirmyn&#x3E;", currentText: "Šiandien", monthNames: ["Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa", "Rugpjūtis", "Rugsėjis", "Spalis", "Lapkritis", "Gruodis"], monthNamesShort: ["Sau", "Vas", "Kov", "Bal", "Geg", "Bir", "Lie", "Rugp", "Rugs", "Spa", "Lap", "Gru"], dayNames: ["sekmadienis", "pirmadienis", "antradienis", "trečiadienis", "ketvirtadienis", "penktadienis", "šeštadienis"], dayNamesShort: ["sek", "pir", "ant", "tre", "ket", "pen", "šeš"], dayNamesMin: ["Se", "Pr", "An", "Tr", "Ke", "Pe", "Še"], weekHeader: "Wk", dateFormat: "yy-mm-dd", firstDay: 1, isRTL: !1, showMonthAfterYear: !1, yearSuffix: ""}), e.fullCalendar.lang("lt", {buttonText: {month: "Mėnuo", week: "Savaitė", day: "Diena", list: "Darbotvarkė"}, allDayText: "Visą dieną"})
});