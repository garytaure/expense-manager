<template>
  <div class="container-fluid">
    <div class="row" v-if="DashboardData">
      <div class="col-12 col-sm-6">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Users</h5>
            <p class="card-text">{{ DashboardData.usersTotal }} Users</p>
            <router-link to="/users" class="card-link">View All</router-link>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Roles</h5>
            <p class="card-text">
              {{ DashboardData.userRolesTotal }} User Roles
            </p>
            <router-link to="/user-roles" class="card-link"
              >View All</router-link
            >
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Expenses</h5>
            <p class="card-text">{{ DashboardData.userRolesTotal }} Expenses</p>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Expense Categories</h5>
            <p class="card-text">
              {{ DashboardData.userRolesTotal }} Expense Categories
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "Dashboard",
  components: {},
  data() {
    return {
      form: {
        title: "",
        write_up: "",
      },
    };
  },
  created: function () {
    // a function to call getDashboard action
    this.GetDashboardData(1);
  },
  computed: {
    ...mapGetters({ DashboardData: "StateDashboardData" }),
  },
  methods: {
    ...mapActions(["CreatePost", "GetDashboardData"]),
    async submit() {
      try {
        await this.CreatePost(this.form);
      } catch (error) {
        throw "Sorry you can't make a post now!";
      }
    },
  },
};
</script>
