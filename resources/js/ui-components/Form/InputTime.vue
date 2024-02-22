<template>
  <div :class="Couple ? 'mb-4.5' : 'w-full xl:w-1/2'">
    <label class="mb-2.5 block text-black dark:text-white">
      {{ Label }}
    </label>
    <input
      @input="onInput($event.target.value)"
      :value="Value"
      :class="isError == true ? 'isError' : ''"
      id="time-input"
      class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
    />
    <p v-if="isError" class="text-danger">{{ message }}</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      TimeValue: "",
      DateTime: "",
    };
  },
  props: {
    Couple: {
      type: Boolean,
      default: true,
    },
    Label: {
      type: String,
      default: "Input label",
    },
    Value: {
      type: [String, Boolean, Number],
      default: '01:00',
    },
    Type: {
      type: String,
      default: "text",
    },
    isError: {
      type: Boolean,
      default: false,
    },
    isLoginError: {
      type: Boolean,
      default: false,
    },
    message: {
      type: String,
      default: "",
    },
  },

  methods: {
    onInput(val) {
      const input = document.getElementById("time-input");
      // Kiritilgan qiymatni olamiz
      let value = val;

      // Faqat raqamlarni qabul qilish uchun regex
      const regex = /^[0-9]*$/;

      // Raqamlar va kiritilgan belgilar sonini tekshiramiz
      if (value.length === 4 && regex.test(value)) {
        // Raqamlarni o'zlashtiramiz
        const hours = value.substr(0, 2);
        const minutes = value.substr(2, 2);

        // Vaqt formatini tekshiramiz
        if (parseInt(hours) < 24 && parseInt(minutes) < 60) {
          // Yangi qiymatni joylashtiramiz
          input.value = hours + ":" + minutes;
        }
      }
      this.$emit('onInput', val);
    },
  },

  mounted() {
    this.onInput;
  },
};
</script>

<style>
.isError {
  border: 1px solid #ff0000 !important;
}
</style>
