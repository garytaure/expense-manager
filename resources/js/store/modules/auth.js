import axios from "axios";

const state = {
  apiToken: null,
  user: null,
  dashboardData: null,

  users: null,
  selectedUser: null,

  userRoles: null,
  expenses: null,
  expenseCategories: null
};

const getters = {
  isAuthenticated: (state) => !!state.user,
  StateAPIToken: (state) => state.apiToken,

  StateUser: (state) => state.user,
  StateSelectedUser: (state) => state.selectUser,

  StateDashboardData: (state) => state.dashboardData,
  StateUsers: (state) => state.users,
  StateUserRoles: (state) => state.userRoles,
};

const actions = {
  async Register({ dispatch }, form) {
    await axios.post('register', form)
    let UserForm = new FormData()
    UserForm.append('email', form.email)
    UserForm.append('password', form.password)
    await dispatch('LogIn', UserForm)
  },

  async LogIn({ commit }, user) {
    let response = await axios.post("login", user);
    if (response && response.status == 200)
      await commit("setUser", response.data.data);
  },

  async GetDashboardData({ commit, getters }) {
    let apiToken = await getters.StateAPIToken;
    let response = await axios.get("dashboard", { headers: { "X-API-TOKEN": apiToken } });
    if (response && response.status == 200)
      commit("setDashboardData", response.data.data);
  },

  async SelectUser({ commit, getters }, id) {
    commit("selectUser", null);
    let apiToken = await getters.StateAPIToken;
    let response = await axios.get("users/" + id, { headers: { "X-API-TOKEN": apiToken } });
    if (response && response.status == 200)
      commit("selectUser", response.data.data);
  },
  async UpdatetUser({ commit, getters }, id, user) {
    let apiToken = await getters.StateAPIToken;
    let response = await axios.put("users/" + id, user, { headers: { "X-API-TOKEN": apiToken } });
    if (response && response.status == 200)
      commit("selectUser", response.data.data);
  },

  async GetUsers({ commit, getters }) {
    let apiToken = await getters.StateAPIToken;
    let response = await axios.get("users", { headers: { "X-API-TOKEN": apiToken } });
    if (response && response.status == 200)
      commit("setUsers", response.data.data);
  },

  async GetUserRoles({ commit, getters }) {
    let apiToken = await getters.StateAPIToken;
    let response = await axios.get("user-roles", { headers: { "X-API-TOKEN": apiToken } });
    if (response && response.status == 200)
      commit("setUserRoles", response.data.data);
  },

  async GetExpenses({ commit, getters }) {
    let apiToken = await getters.StateAPIToken;
    let response = await axios.get("expenses", { headers: { "X-API-TOKEN": apiToken } });
    if (response && response.status == 200)
      commit("setExpenses", response.data.data);
  },

  async GetExpenseCategories({ commit, getters }) {
    let apiToken = await getters.StateAPIToken;
    let response = await axios.get("expense-categories", { headers: { "X-API-TOKEN": apiToken } });
    if (response && response.status == 200)
      commit("setExpenseCategories", response.data.data);
  },

  async LogOut({ commit }) {
    let user = null;
    commit("logout", user);
  },
};

const mutations = {
  setDashboardData(state, data) {
    state.dashboardData = data;
    console.log('Dashboard', data);
  },

  setUser(state, user) {
    state.apiToken = user.api_token;
    state.user = user;
  },
  selectUser(state, user) {
    state.selectUser = user;
  },

  setUsers(state, users) {
    state.users = users;
  },
  setUserRoles(state, roles) {
    state.userRoles = roles;
  },
  setExpenses(state, expenses) {
    state.expenses = expenses;
  },
  setExpenseCategories(state, expenseCategories) {
    state.expenseCategories = expenseCategories;
  },
  logout(state, user) {
    state.apiToken = null;
    state.user = user;
  },
};

export default {
  state,
  getters,
  actions,
  mutations
};
