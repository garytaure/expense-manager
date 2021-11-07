<template>
  <div class="container-fluid">
    <div class="row" v-if="SelectedUser && UserRoles">
      <div class="col-12">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">User Info</h5>
            <form @submit.prevent="submit">
              <div class="form-group">
                <label for="role_id">Role</label>
                <select
                  class="form-control"
                  name="role_id"
                  v-model="form.role_id"
                >
                  <option>-</option>
                  <option
                    v-for="role in UserRoles"
                    :key="role.id"
                    :value="role.id"
                  >
                    {{ role.name }}
                  </option>
                </select>
              </div>
              <div class="form-group">
                <label for="name">Name</label>
                <input
                  type="text"
                  class="form-control"
                  name="name"
                  v-model="form.name"
                />
              </div>
              <button type="submit" class="btn btn-info">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "UserEditForm",
  components: {},
  data() {
    return {
      form: {
        data_copied: false,
        role_id: 0,
        name: "",
        password: "",
        confirm_password: "",
      },
    };
  },
  created: function () {
    // a function to call getUsers action
    this.SelectUser(this.$route.params.id);
  },
  computed: {
    ...mapGetters({
      SelectedUser: "StateSelectedUser",
      UserRoles: "StateUserRoles",
    }),
  },
  methods: {
    ...mapActions(["SelectUser", "UpdatetUser"]),
    async submit() {
      await this.UpdatetUser(this.$route.params.id, this.form);
    },
    async deletePlayer(id) {},
  },
};
</script>
