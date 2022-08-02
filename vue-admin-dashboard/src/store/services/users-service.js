import qs from 'qs';
import axios from 'axios';
import Jsona from 'jsona';
import baseOptions from "./base-service";
const jsona = new Jsona();

function list(params) {
  const options = {
    params: params,
    paramsSerializer: function (params) {
      return qs.stringify(params, {encode: false});
    }
  };

  return axios.get(`${baseOptions.url}/users`, options)
    .then(response => {
      return {
        list: jsona.deserialize(response.data),
        meta: response.data.meta
      };
    });
}

function get(id) {
  const options = {headers: baseOptions.headers};

  return axios.get(`${baseOptions.url}/users/${id}`, options)
    .then(response => {
      let user = jsona.deserialize(response.data);
      delete user.links;
      return user;
    });
}

function add(user) {
  const payload = jsona.serialize({
    stuff: user,
    includeNames: null
  });

  const options = {headers: baseOptions.headers};

  return axios.post(`${baseOptions.url}/users`, payload, options)
    .then(response => {
      return jsona.deserialize(response.data);
    });
}

function update(user) {
  const payload = jsona.serialize({
    stuff: user,
    includeNames: []
  });

  const options = {headers: baseOptions.headers};

  return axios.patch(`${baseOptions.url}/users/${user.id}`, payload, options)
    .then(response => {
      return jsona.deserialize(response.data);
    });
}

function destroy(id) {
  const options = {headers: baseOptions.headers};

  return axios.delete(`${baseOptions.url}/users/${id}`, options);
}

function upload(user, image) {
  const bodyFormData = new FormData();
  bodyFormData.append('attachment', image);

  return axios.post(`${baseOptions.url}/uploads/users/${user.id}/profile-image`, bodyFormData)
    .then(response => {
      return response.data.url;
    });
}

export default {
  list,
  get,
  add,
  update,
  destroy,
  upload
};

