<template>
  <div class="container-fluid">
    <div class="row" v-if="UserRoles">
      <div class="col-12">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">UserRoles</h5>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" rowspan="2">ID</th>
                  <th scope="col" rowspan="2">Name</th>
                  <th
                    scope="col"
                    colspan="4"
                    class="bg-dark text-light text-center"
                  >
                    Users
                  </th>
                  <th scope="col" colspan="4" class="text-center">
                    User Roles
                  </th>
                  <th
                    scope="col"
                    colspan="4"
                    class="bg-dark text-light text-center"
                  >
                    Expenses
                  </th>
                  <th scope="col" colspan="4" class="text-center">
                    Expense Categories
                  </th>
                </tr>
                <tr>
                  <th scope="col" class="bg-dark text-light text-center">
                    Create
                  </th>
                  <th scope="col" class="bg-dark text-light text-center">
                    Read
                  </th>
                  <th scope="col" class="bg-dark text-light text-center">
                    Update
                  </th>
                  <th scope="col" class="bg-dark text-light text-center">
                    Delete
                  </th>

                  <th scope="col" class="text-center">Create</th>
                  <th scope="col" class="text-center">Read</th>
                  <th scope="col" class="text-center">Update</th>
                  <th scope="col" class="text-center">Delete</th>

                  <th scope="col" class="bg-dark text-light text-center">
                    Create
                  </th>
                  <th scope="col" class="bg-dark text-light text-center">
                    Read
                  </th>
                  <th scope="col" class="bg-dark text-light text-center">
                    Update
                  </th>
                  <th scope="col" class="bg-dark text-light text-center">
                    Delete
                  </th>

                  <th scope="col" class="text-center">Create</th>
                  <th scope="col" class="text-center">Read</th>
                  <th scope="col" class="text-center">Update</th>
                  <th scope="col" class="text-center">Delete</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="role in UserRoles" :key="role.id">
                  <th scope="row">{{ role.id }}</th>
                  <td>{{ role.name }}</td>
                  <td class="bg-dark text-light text-center">
                    <input
                      type="checkbox"
                      v-model="role.user_create"
                      :disabled="true"
                    />
                  </td>
                  <td class="bg-dark text-light text-center">
                    <input
                      type="checkbox"
                      v-model="role.user_read"
                      :disabled="true"
                    />
                  </td>
                  <td class="bg-dark text-light text-center">
                    <input
                      type="checkbox"
                      v-model="role.user_update"
                      :disabled="true"
                    />
                  </td>
                  <td class="bg-dark text-light text-center">
                    <input
                      type="checkbox"
                      v-model="role.user_delete"
                      :disabled="true"
                    />
                  </td>

                  <td class="text-center">
                    <input
                      type="checkbox"
                      v-model="role.role_create"
                      :disabled="true"
                    />
                  </td>
                  <td class="text-center">
                    <input
                      type="checkbox"
                      v-model="role.role_read"
                      :disabled="true"
                    />
                  </td>
                  <td class="text-center">
                    <input
                      type="checkbox"
                      v-model="role.role_update"
                      :disabled="true"
                    />
                  </td>
                  <td class="text-center">
                    <input
                      type="checkbox"
                      v-model="role.role_delete"
                      :disabled="true"
                    />
                  </td>

                  <td class="bg-dark text-light text-center">
                    <input
                      type="checkbox"
                      v-model="role.expense_create"
                      :disabled="true"
                    />
                  </td>
                  <td class="bg-dark text-light text-center">
                    <input
                      type="checkbox"
                      v-model="role.expense_read"
                      :disabled="true"
                    />
                  </td>
                  <td class="bg-dark text-light text-center">
                    <input
                      type="checkbox"
                      v-model="role.expense_update"
                      :disabled="true"
                    />
                  </td>
                  <td class="bg-dark text-light text-center">
                    <input
                      type="checkbox"
                      v-model="role.expense_delete"
                      :disabled="true"
                    />
                  </td>

                  <td class="text-center">
                    <input
                      type="checkbox"
                      v-model="role.expense_category_create"
                      :disabled="true"
                    />
                  </td>
                  <td class="text-center">
                    <input
                      type="checkbox"
                      v-model="role.expense_category_read"
                      :disabled="true"
                    />
                  </td>
                  <td class="text-center">
                    <input
                      type="checkbox"
                      v-model="role.expense_category_update"
                      :disabled="true"
                    />
                  </td>
                  <td class="text-center">
                    <input
                      type="checkbox"
                      v-model="role.expense_category_delete"
                      :disabled="true"
                    />
                  </td>
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
  name: "UserRoles",
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
    // a function to call getUserRoles action
    this.GetUserRoles();
  },
  computed: {
    ...mapGetters({ UserRoles: "StateUserRoles" }),
  },
  methods: {
    ...mapActions(["GetUserRoles"]),
    viewUserRole(id) {
      this.$router.push("/user-roles/" + id);
    },
  },
};
</script>
