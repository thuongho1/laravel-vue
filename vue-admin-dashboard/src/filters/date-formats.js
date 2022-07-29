import Vue from "vue";
import moment from "moment";

const formatDate = Vue.filter('formatDate', function (value) {
  if (value) {
    return moment(String(value)).format('MM/DD/YYYY hh:mm');
  }
});

export default formatDate;
