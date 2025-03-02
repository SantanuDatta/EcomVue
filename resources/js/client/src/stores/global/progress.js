import { defineStore } from 'pinia';
import { useNProgress } from '@vueuse/integrations/useNProgress';

const progress = useNProgress();

export const useProgressStore = defineStore('progress', {
  state: () => ({
    isLoading: false
  }),
  actions: {
    start() {
      this.isLoading = true;
      progress.start();
    },
    done() {
      this.isLoading = false;
      progress.done();
    }
  }
});
