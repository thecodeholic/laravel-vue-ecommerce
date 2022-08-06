import './bootstrap';

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse'

Alpine.plugin(collapse)

window.Alpine = Alpine;

document.addEventListener("alpine:init", () => {
  Alpine.store("header", {
    cartItemsObject: {},
    watchingItems: [],
    get watchlistItems() {
      return this.watchingItems.length;
    },
    get cartItems() {
      return Object.values(this.cartItemsObject).reduce(
        (accum, next) => accum + parseInt(next.quantity),
        0
      );
    },
  });

  Alpine.data("toast", () => ({
    visible: false,
    delay: 5000,
    percent: 0,
    interval: null,
    timeout: null,
    message: null,
    close() {
      this.visible = false;
      clearInterval(this.interval);
    },
    show(message) {
      this.visible = true;
      this.message = message;

      if (this.interval) {
        clearInterval(this.interval);
        this.interval = null;
      }
      if (this.timeout) {
        clearTimeout(this.timeout);
        this.timeout = null;
      }

      this.timeout = setTimeout(() => {
        this.visible = false;
        this.timeout = null;
      }, this.delay);
      const startDate = Date.now();
      const futureDate = Date.now() + this.delay;
      this.interval = setInterval(() => {
        const date = Date.now();
        this.percent = ((date - startDate) * 100) / (futureDate - startDate);
        if (this.percent >= 100) {
          clearInterval(this.interval);
          this.interval = null;
        }
      }, 30);
    },
  }));

  Alpine.data("productItem", (product) => {
    return {
      id: product.id,
      product,
      quantity: 1,
      get watchlistItems() {
        return this.$store.watchlistItems;
      },
      addToWatchlist() {
        if (this.isInWatchlist()) {
          this.$store.header.watchingItems.splice(
            this.$store.header.watchingItems.findIndex(
              (p) => p.id === product.id
            ),
            1
          );
          this.$dispatch("notify", {
            message: "The item was removed from your watchlist",
          });
        } else {
          this.$store.header.watchingItems.push(product);
          this.$dispatch("notify", {
            message: "The item was added into the watchlist",
          });
        }
      },
      isInWatchlist() {
        return this.$store.header.watchingItems.find(
          (p) => p.id === product.id
        );
      },
      addToCart(id, quantity = 1) {
        this.$store.header.cartItemsObject[id] = this.$store.header
          .cartItemsObject[id] || {...product, quantity: 0};
        this.$store.header.cartItemsObject[id].quantity =
          parseInt(this.$store.header.cartItemsObject[id].quantity) + parseInt(quantity);
        this.$dispatch("notify", {
          message: "The item was added into the cart",
        });
      },
      removeItemFromCart() {
        delete this.$store.header.cartItemsObject[this.id];
        this.$dispatch("notify", {
          message: "The item was removed from cart",
        });
      },
      removeFromWatchlist() {
        this.$store.header.watchingItems.splice(
          this.$store.header.watchingItems.findIndex((p) => p.id === this.id),
          1
        );
      },
    };
  });

  Alpine.data("signupForm", () => ({
    defaultClasses: "border-gray-300 focus:ring-purple-500 focus:border-purple-500",
    errorClasses:
      "border-red-600 focus:border-red-600 ring-1 ring-red-600 focus:ring-red-600",
    successClasses:
      "border-emerald-500 focus:border-emerald-500 ring-1 ring-emerald-500 focus:ring-emerald-500",

    form: {
      name: "",
      email: "",
      password: "",
      password_repeat: "",
    },
    errors: {
      name: "",
      email: "",
      password: "",
      password_repeat: "",
    },
    submit() {
      console.log(this.form);
      this.validateName();
      this.validateEmail();
      this.validatePassword();
      this.validatePasswordRepeat();
    },
    validateName() {
      this.errors.name = "";

      if (!this.form.name) {
        this.errors.name = "This field is required";
      } else if (this.form.name.length < 2) {
        this.errors.name = "The name should be at least two characters";
      }
    },
    validateEmail() {
      this.errors.email = "";

      if (!this.form.email) {
        this.errors.email = "This field is required";
      } else if (!this.validateEmailWithRegex()) {
        this.errors.email = "This must be a valid email field";
      }
    },
    validateEmailWithRegex() {
      return /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
        this.form.email
      );
    },
    validatePassword() {
      this.errors.password = "";

      if (!this.form.password) {
        this.errors.password = "This field is required";
      }
    },
    validatePasswordRepeat() {
      this.errors.password_repeat = "";

      if (!this.form.password_repeat) {
        this.errors.password_repeat = "This field is required";
      }
    }
  }));
});


Alpine.start();
