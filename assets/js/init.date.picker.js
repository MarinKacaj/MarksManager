/**
 * Created by C.R.C on 6/25/2015.
 */

/**
 *
 * @param {String} selector
 */
function initDatePicker(selector) {

    $(selector).datepicker({
        monthsShort: ["Jan", "Shk", "Mar", "Pri", "Maj", "Qer", "Korr", "Gu", "Shta", "Tet", "Nen", "Dhj"],
        weekdaysShort: ["Hen", "Ma", "Mer", "Enj", "Pre", "Sht", "Die"],
        today: "Sot",
        clear: "Pastro",
        close: "Mbyll",
        labelMonthNext: "Muaji tjet&euml;r",
        labelMonthPrev: "Muaji i kaluar",
        format: "dd/mm/yyyy"
    });
}