
<script>
import { ref } from 'vue'
import { Dialog, DialogPanel, Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems, TransitionChild, TransitionRoot, } from '@headlessui/vue'
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline'
import { Head, Link, useForm } from '@inertiajs/vue3';
import Navbar from '@/Components/NavBar.vue';

export default {

  props: {
    products: {
      type: Object,
      default: () => ({}),
    },
    filters: {
      type: Object,
      default: () => ({}),
    },
  },
  components: {
    Navbar,
  },
  data() {
    return {
      searchQuery: '',
      showDeleteConfirmation: false,
      productIdToDelete: null,
      selectedSort: 'newest',
      showProduct: false,
      productDetails: '',
      showCreateModal: false,
      showSuccessModal: false,
      successMessage: '',
      productToEdit: null,
      showEditConfirmation: false,



      
      form: useForm({
        name: '',
        description: '',
        price: '',
        size: '',
        type: '',
      })
    };
  },
  methods: {
    searchProducts() {
      this.$inertia.get(
        this.route('product.index', {
          search: this.searchQuery,
        }),
      );
    },
    confirmDelete() {
      if (this.productIdToDelete !== null) {
        this.$inertia.delete(route('product.destroy', this.productIdToDelete));
        this.showDeleteConfirmation = false;
      }
      this.productIdToDelete = null;
    },
    generatePageLink(page) {
      let link = '?page=' + page;

      if (this.filters.search) {
        link += '&search=' + encodeURIComponent(this.filters.search);
      }

      return link;
    },
    sortProducts() {
      this.$inertia.get(
        this.route('product.index', {
          search: this.searchQuery,
          sort: this.selectedSort,
          page: this.products.current_page,
        }),
      );
    },
    confirmShow() {
      if (this.productIdToShow !== null) {
        this.$inertia.get(route('product.show', this.productIdToShow));
        this.showProduct = false;
      }
      this.productIdToShow = null;
    },
    formatCreatedAt(created_at) {
      const createdAtDate = new Date(created_at);

      const formattedDate = createdAtDate.toLocaleString('en-US', {
        month: 'short',
        day: 'numeric',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
      });
      return formattedDate;
    },
    cancelAction() {
      this.showCreateModal = false;
      this.showEditConfirmation = false;
      this.showProduct = false;
      this.showDeleteConfirmation = false;
      this.productToEdit = null;
      this.productIdToDelete = null;
      this.productIdToShow = null;

      this.form.reset();
    },

    CreateProduct() {
      this.showCreateModal = false;
      this.successMessage = 'Product created successfully.';
      this.showSuccessModal = true;
      this.form
        .post(route('product.store'))
        .then(() => {

        })
        .catch((error) => {
          console.error(error);
        });
    },

    closeSuccessModal() {
      this.showSuccessModal = false;
      this.successMessage = '';
    },

    updateProduct(productToEdit) {
      
      this.form.name = productToEdit.name;
      this.form.description = productToEdit.description;
      this.form.price = productToEdit.price;
      this.form.size = productToEdit.size;
      this.form.type = productToEdit.type;

      console.log(productToEdit )


      this.showEditConfirmation = false;
      this.successMessage = 'Product updated successfully.';
      this.showSuccessModal = true;

      this.form
      .put(route('product.update', { id: productToEdit.id } ))
      .then((response) => {
        console.log(response.data);
      })
      .catch((error) => {
        console.error(error);
      });
        
    },
  },

}


</script>
<template>
  <Navbar />
  <div class="container mx-auto p-6 mt-16">
    <h1 class="text-2xl font-semibold mb-4">Product List</h1>
    <form @submit.prevent="searchProducts">
      <div class="flex items-center justify-between mb-4">
        <div class="flex items-center">
          <label for="search" class="mr-2 text-gray-600">Search:</label>
          <div class="relative">
            <input id="search" type="text" v-model="searchQuery"
              class="border rounded-l-lg py-2 pl-4 pr-10 w-96 focus:outline-none focus:ring-2 focus:ring-blue-400"
              placeholder="Search by name, description, price..." />
            <button type="submit"
              class="absolute top-0 right-0 h-full px-4 bg-blue-500 hover:bg-blue-700 text-white font-semibold rounded-r-lg">
              Search
            </button>
          </div>
          <div class="flex items-center">
            <button class="bg-green-500 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-full mr-6 ml-8"
              @click="showCreateModal = true" type="button">
              Create New Product
            </button>
          </div>
          <div class="flex items-center justify-between mb-4">
          </div>
        </div>
        
        <portal to="modals">
          <div class="fixed inset-0 flex items-center justify-center z-50" v-if="showCreateModal">
            <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
              <div class="modal-content py-4 text-left px-6">
                <h3 class="text-2xl font-semibold mb-4">Create New Product</h3>
                <form @submit.prevent="form.post(route('product.store'))">
                  <div class="text-gray-600">
                    <div class="mb-4">
                      <label for="name" class="block text-sm font-medium text-gray-900">Name:</label>
                      <input type="text" id="name" v-model="form.name"
                        class="border rounded-lg py-2 px-4 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required />
                    </div>
                  </div>
                  <div class="text-gray-600">
                    <div class="mb-4">
                      <label for="description" class="block text-sm font-medium text-gray-900">description:</label>
                      <input type="text" id="description" v-model="form.description"
                        class="border rounded-lg py-2 px-4 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required />
                    </div>
                  </div>
                  <div class="text-gray-600">
                    <div class="mb-4">
                      <label for="price" class="block text-sm font-medium text-gray-900">price:</label>
                      <input type="number" id="price" v-model="form.price"
                        class="border rounded-lg py-2 px-4 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required />
                    </div>
                  </div>
                  <div class="text-gray-600">
                    <div class="mb-4">
                      <label for="size" class="block text-sm font-medium text-gray-900">size:</label>
                      <input type="text" id="size" v-model="form.size"
                        class="border rounded-lg py-2 px-4 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required />
                    </div>
                  </div>
                  <div class="text-gray-600">
                    <div class="mb-4">
                      <label for="type" class="block text-sm font-medium text-gray-900">type:</label>
                      <input type="text" id="type" v-model="form.type"
                        class="border rounded-lg py-2 px-4 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                        required />
                    </div>
                  </div>
                  <div class="mt-5 flex justify-end">
                    <button type="submit" @click="CreateProduct"
                      class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mr-2">
                      Save
                    </button>
                    <button type="button" @click="cancelAction"
                      class="bg-gray-300 text-gray-700 hover:bg-gray-400 font-semibold py-2 px-4 rounded mr-2">
                      Cancel
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </portal>



        <portal to="modals">
          <div class="fixed inset-0 flex items-center justify-center z-50" v-if="showSuccessModal">
            <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
              <div class="modal-content py-4 text-left px-6">
                <h3 class="text-2xl font-semibold mb-4">Success</h3>
                <p>{{ successMessage }}</p>
                <div class="mt-5 flex justify-end">
                  <button @click="closeSuccessModal"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mr-2">
                    Close
                  </button>
                </div>
              </div>
            </div>
          </div>
        </portal>




        <label for="sort" class="mr-2 text-gray-600"></label>
        <div class="relative">
          <select id="sort" v-model="selectedSort" @change="sortProducts"
            class="border rounded-l-lg py-2 pr-10 w-64 focus:outline-none focus:ring-2 focus:ring-blue-400 appearance-none bg-white hover:bg-gray-100 px-4">
            <option value="newest">Newest</option>
            <option value="lowToHigh">Price: Low to High</option>
            <option value="highToLow">Price: High to Low</option>
          </select>
          <svg class="w-4 h-4 absolute right-3 top-3 text-gray-500 pointer-events-none" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd"
              d="M10.293 3.293a1 1 0 011.414 0l5 5a1 1 0 01-1.414 1.414L11 6.414V16a1 1 0 11-2 0V6.414L4.707 9.707a1 1 0 01-1.414-1.414l5-5z"
              clip-rule="evenodd" />
          </svg>
        </div>
      </div>
    </form>

    <div class="overflow-x-auto">
      <table class="min-w-full table-auto">
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
          aria-hidden="true">
          <div
            class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
            style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" />
        </div>
        <thead>
          <tr>
            <th class="px-4 py-2 bg-gray-100">Name</th>
            <th class="px-4 py-2 bg-gray-100">Description</th>
            <th class="px-4 py-2 bg-gray-100">Price</th>
            <th class="px-4 py-2 bg-gray-100">Size</th>
            <th class="px-4 py-2 bg-gray-100">Type</th>
            <th class="px-4 py-2 bg-gray-100">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products.data" :key="products.id">
            <td class="border px-4 py-2">{{ product.name }}</td>
            <td class="border px-4 py-2">{{ product.description }}</td>
            <td class="border px-4 py-2">{{ product.price }}</td>
            <td class="border px-4 py-2">{{ product.size }}</td>
            <td class="border px-4 py-2">{{ product.type }}</td>
            <td class="border px-4 py-2">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-semibold px-2 py-1 rounded-full mr-2"
                @click="productToEdit = product; showEditConfirmation = true">
                  Edit
                </button>

              <button class="bg-red-500 hover:bg-red-700 text-white font-semibold px-2 py-1 rounded-full"
                @click="productIdToDelete = product.id; showDeleteConfirmation = true">
                Delete
              </button>

              <button class="bg-orange-500 hover:bg-red-700 text-white font-semibold px-2 py-1 rounded-full mr-2 ml-2"
                @click="productToShow = product; showProduct = true">
                Show
              </button>



              <portal to="modals">
                <div class="fixed inset-0 flex items-center justify-center z-50" v-if="showEditConfirmation">
                  <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                    <div class="modal-content py-4 text-left px-6">
                      <h3 class="text-2xl font-semibold mb-4">Update Product</h3>
                      <form @submit.prevent="updateProduct(productToEdit)">
                        <div class="text-gray-600">
                          <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-900">Name:</label>
                            <input type="text" id="name" v-model="productToEdit.name"
                              class="border rounded-lg py-2 px-4 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                              required />
                          </div>
                        </div>
                        <div class="text-gray-600">
                          <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-900">description:</label>
                            <input type="text" id="description" v-model="productToEdit.description"
                              class="border rounded-lg py-2 px-4 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                              required />
                          </div>
                        </div>
                        <div class="text-gray-600">
                          <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-900">price:</label>
                            <input type="number" id="price" v-model="productToEdit.price"
                              class="border rounded-lg py-2 px-4 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                              required />
                          </div>
                        </div>
                        <div class="text-gray-600">
                          <div class="mb-4">
                            <label for="size" class="block text-sm font-medium text-gray-900">size:</label>
                            <input type="text" id="size" v-model="productToEdit.size"
                              class="border rounded-lg py-2 px-4 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                              required />
                          </div>
                        </div>
                        <div class="text-gray-600">
                          <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-900">type:</label>
                            <input type="text" id="type" v-model="productToEdit.type"
                              class="border rounded-lg py-2 px-4 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                              required />
                          </div>
                        </div>
                        <div class="mt-5 flex justify-end">
                          <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mr-2">
                            Update
                          </button>
                          <button type="button" @click="cancelAction"
                            class="bg-gray-300 text-gray-700 hover:bg-gray-400 font-semibold py-2 px-4 rounded mr-2">
                            Cancel
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
        </portal>





              <portal to="modals">
                <div class="fixed inset-0 flex items-center justify-center z-50" v-if="showProduct">
                  <div
                    class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                    <div class="modal-content py-4 text-left px-6">
                      <h3 class="text-2xl font-semibold mb-4">Product Details</h3>
                      <div class="text-gray-600">
                        <div><strong>ID:</strong> {{ productToShow.id }}</div>
                        <div><strong>Name:</strong> {{ productToShow.name }}</div>
                        <div><strong>Description:</strong> {{ productToShow.description }}</div>
                        <div><strong>Price:</strong> {{ productToShow.price }}</div>
                        <div><strong>Size:</strong> {{ productToShow.size }}</div>
                        <div><strong>Type:</strong> {{ productToShow.type }}</div>
                        <div><strong>Created At:</strong> {{ formatCreatedAt(productToShow.created_at) }}</div>
                      </div>
                      <div class="mt-5 flex justify-end">
                        <button @click="cancelAction"
                          class="bg-gray-300 text-gray-700 hover:bg-gray-400 font-semibold py-2 px-4 rounded mr-2">
                          Cancel
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </portal>

              <portal to="modals">
                <div class="fixed inset-0 flex items-center justify-center z-50" v-if="showDeleteConfirmation">
                  <div
                    class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                    <div class="modal-content py-4 text-left px-6">
                      <h3 class="text-2xl font-semibold mb-4">Confirm Deletion</h3>
                      <p class="text-gray-600">Are you sure you want to delete this product? This action cannot be undone.
                      </p>
                      <div class="mt-5 flex justify-end">
                        <button @click="cancelAction"
                          class="bg-gray-300 text-gray-700 hover:bg-gray-400 font-semibold py-2 px-4 rounded mr-2">
                          Cancel
                        </button>
                        <button @click="confirmDelete"
                          class="bg-red-500 text-white hover:bg-red-600 font-semibold py-2 px-4 rounded">
                          Confirm
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </portal>
            </td>
          </tr>
        </tbody>
      </table>

      <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
        <div class="flex flex-1 justify-between sm:hidden">
          <a v-if="products.prev_page_url" :href="products.prev_page_url"
            class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
            Previous
          </a>
          <a v-if="products.next_page_url" :href="products.next_page_url"
            class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
            Next
          </a>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
          <div>
            <p class="text-sm text-gray-700">
              Showing
              {{ products.from }}
              to
              {{ products.to }}
              of
              {{ products.total }}
              results
            </p>
          </div>
          <div>
            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
              <a v-for="page in products.last_page" :key="page" :href="generatePageLink(page)"
                :class="['relative inline-flex items-center px-4 py-2 text-sm font-semibold', { 'bg-indigo-600 text-white': page === products.current_page, 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0': page !== products.current_page }]">
                {{ page }}
              </a>
            </nav>
          </div>
        </div>
      </div>
      <div
        class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
        aria-hidden="true">
        <div
          class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
          style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" />
      </div>
    </div>
  </div>
</template>