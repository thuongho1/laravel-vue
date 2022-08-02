import DashboardLayout from "@/pages/Dashboard/Layout/DashboardLayout.vue";
import AuthLayout from "@/pages/Dashboard/Pages/AuthLayout.vue";

// Dashboard pages
import Dashboard from "@/pages/Dashboard/Dashboard.vue";
// Profile
import UserProfile from "@/pages/Dashboard/Pages/UserProfile/UserProfile.vue";

// User Management
import ListUserPage from "@/pages/Dashboard/Pages/UserManagement/ListUserPage.vue";

// Pages
import Login from "@/pages/Dashboard/Pages/Login.vue";
import Register from "@/pages/Dashboard/Pages/Register.vue";

// Components pages
import Notifications from "@/pages/Dashboard/Components/Notifications.vue";
import Icons from "@/pages/Dashboard/Components/Icons.vue";
import Typography from "@/pages/Dashboard/Components/Typography.vue";


// Posts pages
import CreatePost from "@/pages/Dashboard/Pages/PostManagement/CreatePostPage.vue";
import UpdatePost from "@/pages/Dashboard/Pages/PostManagement/UpdatePostPage.vue";
import DeletePost from "@/pages/Dashboard/Pages/PostManagement/DeletePostPage.vue";

import ListPostPage from "@/pages/Dashboard/Pages/PostManagement/ListPostPage.vue";


// TableList pages
import RegularTables from "@/pages/Dashboard/Tables/RegularTables.vue";

// Maps pages
import FullScreenMap from "@/pages/Dashboard/Maps/FullScreenMap.vue";

//import middleware
import auth from "@/middleware/auth";
import guest from "@/middleware/guest";

let postMenu = {
  path: "/admin/posts",
  component: DashboardLayout,
  name: "Posts",
  children: [
    {
      path: "",
      name: "List Posts",
      components: {default: ListPostPage},
      meta: {middleware: auth}
    },
    {
      path: "/admin/post/create",
      name: "Create Post",
      components: {default: CreatePost},
      meta: {middleware: auth}
    },
    {
      path: "/admin/post/update/:id",
      props: {default: true},
      name: "Update Post",
      components: {default: UpdatePost},
      meta: {middleware: auth}
    },
    {
      path: "/admin/post/delete/:id",
      props: {default: true},
      name: "Delete Post",
      components: {default: DeletePost},
      meta: {middleware: auth}
    },
  ]
};

let componentsMenu = {
  path: "/admin/components",
  component: DashboardLayout,
  name: "Components",
  children: [
    {
      path: "table",
      name: "Table",
      components: {default: RegularTables},
      meta: {middleware: auth}
    },
    {
      path: "typography",
      name: "Typography",
      components: {default: Typography},
      meta: {middleware: auth}
    },
    {
      path: "icons",
      name: "Icons",
      components: {default: Icons},
      meta: {middleware: auth}
    },
    {
      path: "maps",
      name: "Maps",
      meta: {
        hideContent: true,
        hideFooter: true,
        navbarAbsolute: true,
        middleware: auth
      },
      components: {default: FullScreenMap}
    },
    {
      path: "notifications",
      name: "Notifications",
      components: {default: Notifications},
      meta: {middleware: auth}
    },
  ]
};

let userMenu = {
  path: "/admin/users",
  component: DashboardLayout,
  name: "Users",
  children: [
    {
      path: "/admin/user-profile",
      name: "User Profile",
      components: {default: UserProfile},
      meta: {middleware: auth}
    },
    {
      path: "",
      name: "List Users",
      components: {default: ListUserPage},
      meta: {middleware: auth}
    },
  ]
};


let authPages = {
  path: "/",
  component: AuthLayout,
  name: "Authentication",
  children: [
    {
      path: "/login",
      name: "Login",
      component: Login,
      meta: {middleware: guest}
    },
    {
      path: "/register",
      name: "Register",
      component: Register,
      meta: {middleware: guest}
    }
  ]
};

const routes = [
  {
    path: "/",
    redirect: "/admin",
    name: "Home"
  },
  {
    path: "/",
    component: DashboardLayout,
    meta: {middleware: auth},
    children: [
      {
        path: "admin",
        name: "Admin Dashboard",
        components: {default: Dashboard},
        meta: {middleware: auth}
      }
    ]
  },
  componentsMenu,
  userMenu,
  postMenu,
  authPages
];

export default routes;
