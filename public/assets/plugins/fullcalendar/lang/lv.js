(function(e) {
    "function" == typeof define && define.amd ? define(["jquery", "moment"], e) : e(jQuery, moment)
})(function(e, t) {
    function a(e, t, a) {
        var n = e.split("_");
        return a ? 1 === t % 10 && 11 !== t ? n[2] : n[3] : 1 === t % 10 && 11 !== t ? n[0] : n[1]
    }
    function n(e, t, n) {
        return e + " " + a(r[n], e, t)
    }
    var r = {mm: "minūti_minūtes_minūte_minūtes", hh: "stundu_stundas_stunda_stundas", dd: "dienu_dienas_diena_dienas", MM: "mēnesi_mēnešus_mēnesis_mēneši", yy: "gadu_gadus_gads_gadi"};
    t.lang("lv", {months: "janvāris_februāris_marts_aprīlis_maijs_jūnijs_jūlijs_augusts_septembris_oktobris_novembris_decembris".split("_"), monthsShort: "jan_feb_mar_apr_mai_jūn_jūl_aug_sep_okt_nov_dec".split("_"), weekdays: "svētdiena_pirmdiena_otrdiena_trešdiena_ceturtdiena_piektdiena_sestdiena".split("_"), weekdaysShort: "Sv_P_O_T_C_Pk_S".split("_"), weekdaysMin: "Sv_P_O_T_C_Pk_S".split("_"), longDateFormat: {LT: "HH:mm", L: "DD.MM.YYYY", LL: "YYYY. [gada] D. MMMM", LLL: "YYYY. [gada] D. MMMM, LT", LLLL: "YYYY. [gada] D. MMMM, dddd, LT"}, calendar: {sameDay: "[Šodien pulksten] LT", nextDay: "[Rīt pulksten] LT", nextWeek: "dddd [pulksten] LT", lastDay: "[Vakar pulksten] LT", lastWeek: "[Pagājušā] dddd [pulksten] LT", sameElse: "L"}, relativeTime: {future: "%s vēlāk", past: "%s agrāk", s: "dažas sekundes", m: "minūti", mm: n, h: "stundu", hh: n, d: "dienu", dd: n, M: "mēnesi", MM: n, y: "gadu", yy: n}, ordinal: "%d.", week: {dow: 1, doy: 4}}), e.fullCalendar.datepickerLang("lv", "lv", {closeText: "Aizvērt", prevText: "Iepr", nextText: "Nāka", currentText: "Šodien", monthNames: ["Janvāris", "Februāris", "Marts", "Aprīlis", "Maijs", "Jūnijs", "Jūlijs", "Augusts", "Septembris", "Oktobris", "Novembris", "Decembris"], monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "Mai", "Jūn", "Jūl", "Aug", "Sep", "Okt", "Nov", "Dec"], dayNames: ["svētdiena", "pirmdiena", "otrdiena", "trešdiena", "ceturtdiena", "piektdiena", "sestdiena"], dayNamesShort: ["svt", "prm", "otr", "tre", "ctr", "pkt", "sst"], dayNamesMin: ["Sv", "Pr", "Ot", "Tr", "Ct", "Pk", "Ss"], weekHeader: "Nav", dateFormat: "dd-mm-yy", firstDay: 1, isRTL: !1, showMonthAfterYear: !1, yearSuffix: ""}), e.fullCalendar.lang("lv", {buttonText: {month: "Mēnesis", week: "Nedēļa", day: "Diena", list: "Dienas kārtība"}, allDayText: "Visu dienu"})
});