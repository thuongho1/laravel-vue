import qs from 'qs';
import axios from 'axios';
import Jsona from 'jsona';
import baseOptions from "./base-service";

const jsona = new Jsona();
const model = 'posts';

function list(params) {
  const options = {
    params: params,
    paramsSerializer: function (params) {
      return qs.stringify(params, {encode: false});
    }
  };

  return axios.get(`${baseOptions.url}/${model}`, options)
    .then(response => {
      return {
        list: jsona.deserialize(response.data),
        meta: response.data.meta
      };
    });
}

function get(id) {
  const options = {headers: baseOptions.headers};

  return axios.get(`${baseOptions.url}/${model}/${id}`, options)
    .then(response => {
      let post = jsona.deserialize(response.data);
      delete post.links;
      return post;
    });
}

function add(post) {
  const payload = jsona.serialize({
    stuff: post,
    includeNames: null
  });
  console.log(payload);
  const options = {headers: baseOptions.headers};

  return axios.post(`${baseOptions.url}/${model}`, payload, options)
    .then(response => {
      return jsona.deserialize(response.data);
    });
}

function update(post) {
  const payload = jsona.serialize({
    stuff: post,
    includeNames: []
  });

  const options = {headers: baseOptions.headers};

  return axios.patch(`${baseOptions.url}/${model}/${post.id}`, payload, options)
    .then(response => {
      return jsona.deserialize(response.data);
    });
}

function destroy(id) {
  const options = {headers: baseOptions.headers};

  return axios.delete(`${baseOptions.url}/${model}/${id}`, options);
}


export default {
  list,
  get,
  add,
  update,
  destroy,
};

