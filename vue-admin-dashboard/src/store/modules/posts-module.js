import service from '@/store/services/posts-service';

const state = {
  list: {},
  post: {},
  meta: {}
};

const mutations = {
  SET_LIST: (state, list) => {
    state.list = list;
  },
  SET_RESOURCE: (state, post) => {
    state.post = post;
  },
  SET_META: (state, meta) => {
    state.meta = meta;
  }
};

const actions = {
  list({commit, dispatch}, params) {
    return service.list(params)
      .then(({list, meta}) => {
        commit('SET_LIST', list);
        commit('SET_META', meta);
      });
  },

  get({commit, dispatch}, params) {
    return service.get(params)
      .then((post) => { commit('SET_RESOURCE', post); });
  },

  add({commit, dispatch}, params) {
    return service.add(params)
      .then((post) => { commit('SET_RESOURCE', post); });
  },

  update({commit, dispatch}, params) {
    return service.update(params)
      .then((post) => { commit('SET_RESOURCE', post); });
  },

  destroy({commit, dispatch}, params) {
    return service.destroy(params);
  }
};

const getters = {
  list: state => state.list,
  listTotal: state => state.meta.page.total,
  post: state => state.post,
};

const posts = {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};

export default posts;
