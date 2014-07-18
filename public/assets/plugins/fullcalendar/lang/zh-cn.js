(function(e) {
    "function" == typeof define && define.amd ? define(["jquery", "moment"], e) : e(jQuery, moment)
})(function(e, t) {
    t.lang("zh-cn", {months: "一月_二月_三月_四月_五月_六月_七月_八月_九月_十月_十一月_十二月".split("_"), monthsShort: "1月_2月_3月_4月_5月_6月_7月_8月_9月_10月_11月_12月".split("_"), weekdays: "星期日_星期一_星期二_星期三_星期四_星期五_星期六".split("_"), weekdaysShort: "周日_周一_周二_周三_周四_周五_周六".split("_"), weekdaysMin: "日_一_二_三_四_五_六".split("_"), longDateFormat: {LT: "Ah点mm", L: "YYYY-MM-DD", LL: "YYYY年MMMD日", LLL: "YYYY年MMMD日LT", LLLL: "YYYY年MMMD日ddddLT", l: "YYYY-MM-DD", ll: "YYYY年MMMD日", lll: "YYYY年MMMD日LT", llll: "YYYY年MMMD日ddddLT"}, meridiem: function(e, t) {
            var a = 100 * e + t;
            return 600 > a ? "凌晨" : 900 > a ? "早上" : 1130 > a ? "上午" : 1230 > a ? "中午" : 1800 > a ? "下午" : "晚上"
        }, calendar: {sameDay: function() {
                return 0 === this.minutes() ? "[今天]Ah[点整]" : "[今天]LT"
            }, nextDay: function() {
                return 0 === this.minutes() ? "[明天]Ah[点整]" : "[明天]LT"
            }, lastDay: function() {
                return 0 === this.minutes() ? "[昨天]Ah[点整]" : "[昨天]LT"
            }, nextWeek: function() {
                var e, a;
                return e = t().startOf("week"), a = this.unix() - e.unix() >= 604800 ? "[下]" : "[本]", 0 === this.minutes() ? a + "dddAh点整" : a + "dddAh点mm"
            }, lastWeek: function() {
                var e, a;
                return e = t().startOf("week"), a = this.unix() < e.unix() ? "[上]" : "[本]", 0 === this.minutes() ? a + "dddAh点整" : a + "dddAh点mm"
            }, sameElse: "LL"}, ordinal: function(e, t) {
            switch (t) {
                case"d":
                case"D":
                case"DDD":
                    return e + "日";
                case"M":
                    return e + "月";
                case"w":
                case"W":
                    return e + "周";
                default:
                    return e
                }
        }, relativeTime: {future: "%s内", past: "%s前", s: "几秒", m: "1分钟", mm: "%d分钟", h: "1小时", hh: "%d小时", d: "1天", dd: "%d天", M: "1个月", MM: "%d个月", y: "1年", yy: "%d年"}, week: {dow: 1, doy: 4}}), e.fullCalendar.datepickerLang("zh-cn", "zh-CN", {closeText: "关闭", prevText: "&#x3C;上月", nextText: "下月&#x3E;", currentText: "今天", monthNames: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"], monthNamesShort: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"], dayNames: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"], dayNamesShort: ["周日", "周一", "周二", "周三", "周四", "周五", "周六"], dayNamesMin: ["日", "一", "二", "三", "四", "五", "六"], weekHeader: "周", dateFormat: "yy-mm-dd", firstDay: 1, isRTL: !1, showMonthAfterYear: !0, yearSuffix: "年"}), e.fullCalendar.lang("zh-cn", {buttonText: {month: "月", week: "周", day: "日", list: "日程"}, allDayText: "全天"})
});