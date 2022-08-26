<template>
  <!-- App.vue -->
  <v-app>
    <v-app-bar
      floating
      app
      color="white"
      class="justify-end"
    >
      <v-btn
        icon
        @click="logout"
      >
        <v-icon>mdi-logout</v-icon>
      </v-btn>
    </v-app-bar>
    <v-navigation-drawer
      app
      floating
      color="primary"
      dark
    >
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="text-h6">
              Rellon Dental Tagum
          </v-list-item-title>
          <v-list-item-subtitle>
            Dental Clinic
          </v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>
      <v-divider />

      <v-list
        nav
        shaped
        dense
      >
        <v-list-item-group>
          <Link
            v-for="(item,i) in items"
            :key="i"
            as="v-list-item"
            type="button"
            :href="route(item.route)"
            link
            :class="{'v-list-item--active': $page.url === route().current(item.route)}"
          >
            <v-list-item-icon>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item-content>
          </Link>
        </v-list-item-group>
      </v-list>
      <!--    Footer-->
      <v-footer
        class="justify-center"
        absolute
        color="transparent"
      >
        Copyright © 2011-2022
      </v-footer>
    </v-navigation-drawer>


    <!--    Content-->
    <v-main class="grey lighten-4">
      <!-- Provides the application the proper gutter -->
      <v-container fluid>
        <slot />
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue'
    export default {
        components: {
            Link
        },
        data() {
            return {
                showingNavigationDropdown: false,
                items: [
                    {icon:'mdi-view-dashboard',title: 'Dashboard',route:'dashboard'},
                    {icon:'mdi-account-multiple',title: 'Patients',route:'patients.index'}
                ],
            }
        },

        methods: {
            switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },

            logout() {
                this.$inertia.post(route('logout'));
            },
        }
    }
</script>
