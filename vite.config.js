import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import vueJsx from '@vitejs/plugin-vue-jsx'

export default defineConfig({
  css: {
    preprocessorOptions: {
      scss: {
        additionalData: `@import "@/assets/sass/style.scss";`
      }
    },
    devSourcemap: true
  },
  plugins: [
    vue(),
    vueJsx(),
  ],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    }
  },
  devServer: {
		proxy: {
			'/api_server': {
				target: 'http://localhost/practice',//本地
				// target: 'https://tibamef2e.com/cgd103/g2/back/phpfile',//上線
				changeOrigin: true,
				pathRewrite: {
					'^/api_server': ''
				}
			}
		}
	},
  base: "/chd102/g3/back-end/", //緯育
})
