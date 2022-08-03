import axios from 'axios';
import Jsona from 'jsona';
import baseOptions from "./base-service";
const jsona = new Jsona();

function get() {
  return axios.get(`${baseOptions.url}/me`)
    .then(response => {
      return {
        list: jsona.deserialize(response.data),
        meta: response.data.meta
      };
    });
}

function update(profile) {

  const payload = jsona.serialize({
    stuff: profile,
    includeNames: []
  });

  const options = {headers: baseOptions.headers};

  return axios.patch(`${baseOptions.url}/me`, payload, options)
    .then(response => {
      return jsona.deserialize(response.data);
    });
}

export default {
  get,
  update
};
