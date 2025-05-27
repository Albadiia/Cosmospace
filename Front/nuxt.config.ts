// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },

  compatibilityDate: '2025-05-27',

  runtimeConfig: {
    public: {
      apiBase: "",
    },
  },
  // vite: {
  //   css: {
  //     preprocessorOptions: {
  //       sass: {
  //         api: "modern",
  //       },
  //       scss: {
  //         api: "modern-compiler",
  //       },
  //     },
  //   },
  // },
  ssr: false,
})