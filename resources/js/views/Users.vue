<template>
  <div class="container-fluid">
    <div class="row" v-if="Users">
      <div class="col-12">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Users</h5>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Role</th>
                  <!-- th scope="col">Actions</th -->
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in Users" :key="user.id">
                  <th scope="row">{{ user.id }}</th>
                  <td>{{ user.name }}</td>
                  <td>{{ user.email }}</td>
                  <td>{{ user.role }}</td>
                  <!--td>
                    <button
                      class="btn btn-prinary btn-small"
                      @click="viewUser(user.id)"
                    >
                      Edit
                    </button>
                  </td -->
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "Users",
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
    // a function to call getUsers action
    this.GetUsers();
  },
  computed: {
    ...mapGetters({ Users: "StateUsers" }),
  },
  methods: {
    ...mapActions(["GetUsers"]),
    viewUser(id) {
      this.$router.push("/users/" + id);
    },
    async deleteUser(id) {},
  },
};
</script>
