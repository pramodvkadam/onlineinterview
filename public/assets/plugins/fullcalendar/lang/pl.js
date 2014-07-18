(function(e) {
    "function" == typeof define && define.amd ? define(["jquery", "moment"], e) : e(jQuery, moment)
})(function(e, t) {
    function a(e) {
        return 5 > e % 10 && e % 10 > 1 && 1 !== ~~(e / 10) % 10
    }
    function n(e, t, n) {
        var r = e + " ";
        switch (n) {
            case"m":
                return t ? "minuta" : "minutę";
            case"mm":
                return r + (a(e) ? "minuty" : "minut");
            case"h":
                return t ? "godzina" : "godzinę";
            case"hh":
                return r + (a(e) ? "godziny" : "godzin");
            case"MM":
                return r + (a(e) ? "miesiące" : "miesięcy");
            case"yy":
                return r + (a(e) ? "lata" : "lat")
            }
    }
    var r = "styczeń_luty_marzec_kwiecień_maj_czerwiec_lipiec_sierpień_wrzesień_październik_listopad_grudzień".split("_"), i = "stycznia_lutego_marca_kwietnia_maja_czerwca_lipca_sierpnia_września_października_listopada_grudnia".split("_");
    t.lang("pl", {months: function(e, t) {
            return/D MMMM/.test(t) ? i[e.month()] : r[e.month()]
        }, monthsShort: "sty_lut_mar_kwi_maj_cze_lip_sie_wrz_paź_lis_gru".split("_"), weekdays: "niedziela_poniedziałek_wtorek_środa_czwartek_piątek_sobota".split("_"), weekdaysShort: "nie_pon_wt_śr_czw_pt_sb".split("_"), weekdaysMin: "N_Pn_Wt_Śr_Cz_Pt_So".split("_"), longDateFormat: {LT: "HH:mm", L: "DD.MM.YYYY", LL: "D MMMM YYYY", LLL: "D MMMM YYYY LT", LLLL: "dddd, D MMMM YYYY LT"}, calendar: {sameDay: "[Dziś o] LT", nextDay: "[Jutro o] LT", nextWeek: "[W] dddd [o] LT", lastDay: "[Wczoraj o] LT", lastWeek: function() {
                switch (this.day()) {
                    case 0:
                        return"[W zeszłą niedzielę o] LT";
                    case 3:
                        return"[W zeszłą środę o] LT";
                    case 6:
                        return"[W zeszłą sobotę o] LT";
                    default:
                        return"[W zeszły] dddd [o] LT"
                    }
            }, sameElse: "L"}, relativeTime: {future: "za %s", past: "%s temu", s: "kilka sekund", m: n, mm: n, h: n, hh: n, d: "1 dzień", dd: "%d dni", M: "miesiąc", MM: n, y: "rok", yy: n}, ordinal: "%d.", week: {dow: 1, doy: 4}}), e.fullCalendar.datepickerLang("pl", "pl", {closeText: "Zamknij", prevText: "&#x3C;Poprzedni", nextText: "Następny&#x3E;", currentText: "Dziś", monthNames: ["Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień"], monthNamesShort: ["Sty", "Lu", "Mar", "Kw", "Maj", "Cze", "Lip", "Sie", "Wrz", "Pa", "Lis", "Gru"], dayNames: ["Niedziela", "Poniedziałek", "Wtorek", "Środa", "Czwartek", "Piątek", "Sobota"], dayNamesShort: ["Nie", "Pn", "Wt", "Śr", "Czw", "Pt", "So"], dayNamesMin: ["N", "Pn", "Wt", "Śr", "Cz", "Pt", "So"], weekHeader: "Tydz", dateFormat: "dd.mm.yy", firstDay: 1, isRTL: !1, showMonthAfterYear: !1, yearSuffix: ""}), e.fullCalendar.lang("pl", {buttonText: {month: "Miesiąc", week: "Tydzień", day: "Dzień", list: "Plan dnia"}, allDayText: "Cały dzień"})
});