const baseOptions = {
  headers: {
    'Accept': 'application/vnd.api+json',
    'Content-Type': 'application/vnd.api+json',
  },
  url: process.env.VUE_APP_API_BASE_URL,
};

export default baseOptions;
