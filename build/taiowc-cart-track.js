/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/cart-track/ExportPerformancePanel.js":
/*!**************************************************!*\
  !*** ./src/cart-track/ExportPerformancePanel.js ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ ExportPerformancePanel)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/api-fetch */ "@wordpress/api-fetch");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2__);

// ExportPerformancePanel.js


function ExportPerformancePanel() {
  const downloadFile = async format => {
    try {
      const response = await _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2___default()({
        path: `/taiowc/v1/export?format=${format}`,
        method: 'GET',
        parse: false // IMPORTANT for file download
      });

      const blob = await response.blob();
      const url = window.URL.createObjectURL(blob);
      const link = document.createElement('a');
      link.href = url;
      link.download = `taiowc-export.${format}`;
      document.body.appendChild(link);
      link.click();
      link.remove();
      window.URL.revokeObjectURL(url);
    } catch (error) {
      console.error('Export failed:', error);
      alert((0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Failed to export data', 'taiowc'));
    }
  };
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-export-card"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-export-left"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Export Performance Data', 'taiowc')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Download current session datasets in high-fidelity formats for business intelligence and external reporting.', 'taiowc'))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-export-actions"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: "th-export-btn",
    onClick: () => downloadFile('csv')
  }, "\u2193 CSV FORMAT"), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: "th-export-btn secondary",
    onClick: () => downloadFile('json')
  }, "\u2193 JSON DATA")));
}

/***/ }),

/***/ "./src/cart-track/cart-pagination.js":
/*!*******************************************!*\
  !*** ./src/cart-track/cart-pagination.js ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);


function CartPagination({
  currentPage,
  totalPages,
  onPageChange
}) {
  if (totalPages <= 1) return null;
  const handleClick = page => {
    if (page >= 1 && page <= totalPages) {
      onPageChange(page);
    }
  };
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-pagination"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: "th-prev",
    onClick: () => handleClick(currentPage - 1),
    disabled: currentPage === 1
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "dashicons dashicons-arrow-left-alt"
  }), " ", (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Prev', 'taiowc')), [...Array(totalPages)].map((_, index) => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    key: index,
    onClick: () => handleClick(index + 1),
    className: currentPage === index + 1 ? 'active' : ''
  }, index + 1)), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: "th-next",
    onClick: () => handleClick(currentPage + 1),
    disabled: currentPage === totalPages
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Next', 'taiowc'), " ", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "dashicons dashicons-arrow-right-alt"
  })));
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (CartPagination);

/***/ }),

/***/ "./src/cart-track/cart-table.js":
/*!**************************************!*\
  !*** ./src/cart-track/cart-table.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/api-fetch */ "@wordpress/api-fetch");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _product_cart_user_table_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./product-cart-user-table.js */ "./src/cart-track/product-cart-user-table.js");
/* harmony import */ var _cart_pagination_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./cart-pagination.js */ "./src/cart-track/cart-pagination.js");






function StatusTrackerApp() {
  const [data, setData] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)([]);
  const [loading, setLoading] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(true);
  const [userDataLoading, setUserDataLoading] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(false);
  const [selectedUserId, setSelectedUserId] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(null);
  const [userDetails, setUserDetails] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)([]);
  const [componentKey, setComponentKey] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(0);
  const handleUserViewClick = userId => {
    getUserDetails(userId);
    setSelectedUserId(userId);
    setUserDataLoading(true);
  };
  const handleUserBackClick = () => {
    setSelectedUserId(null);
    setUserDataLoading(false);
  };
  const getUserDetails = async userId => {
    try {
      const response = await _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2___default()({
        path: `taiowc/v1/user/${userId}`
      });
      setUserDetails(response);
    } catch (error) {
      console.error('Error fetching user details:', error);
    } finally {
      setUserDataLoading(false);
    }
  };

  // useEffect(() => {
  //     apiFetch({ path: 'taiowc/v1/usercart' })
  //         .then((response) => {
  //             setData(response);
  //             setLoading(false);
  //         })
  //         .catch((error) => {
  //             console.error('Error fetching data:', error);
  //             setLoading(false);
  //         });
  // }, []);

  const fetchData = () => {
    _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2___default()({
      path: 'taiowc/v1/usercart'
    }).then(response => {
      setData(response);
      setLoading(false);
    }).catch(error => {
      console.error('Error fetching data:', error);
      setLoading(false);
    });
  };

  // Pagination states
  const [currentPage, setCurrentPage] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(1);
  const itemsPerPage = 10;
  const indexOfLastItem = currentPage * itemsPerPage;
  const indexOfFirstItem = indexOfLastItem - itemsPerPage;
  const currentItems = data.slice(indexOfFirstItem, indexOfLastItem);
  const totalPages = Math.ceil(data.length / itemsPerPage);
  const handleProductPageChange = pageNumber => {
    setCurrentPage(pageNumber);
  };

  // Pagination cart states
  const [currentCartPage, setCurrentCartPage] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(1);
  const itemsCartPerPage = 10;
  const indexOfLastCartItem = currentCartPage * itemsCartPerPage;
  const indexOfCartFirstItem = indexOfLastCartItem - itemsCartPerPage;
  const currentCartItems = userDetails.slice(indexOfCartFirstItem, indexOfLastCartItem);
  const totalCartPages = Math.ceil(userDetails.length / itemsCartPerPage);
  const handleCartPageChange = pageCartNumber => {
    setCurrentCartPage(pageCartNumber);
  };
  // delete user and product record
  const [deleteLoading, setDeleteLoading] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(false);
  const [deletingUserId, setDeletingUserId] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(null);
  const [deleteMessage, setDeleteMessage] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)('');
  const [fadeOut, setFadeOut] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(false);
  const deleteUser = async userId => {
    if (window.confirm((0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Are you sure you want to delete this user?', 'taiowc'))) {
      setDeleteLoading(true); // Set delete loading to true
      setDeletingUserId(userId);
      try {
        const response = await _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2___default()({
          path: `taiowc/v1/deleteuser/${userId}`,
          method: 'DELETE'
        });
        setData(prevData => prevData.filter(user => user.user_id !== userId));
        setDeleteMessage(response.message);
        setTimeout(() => {
          setFadeOut(true); // Trigger fade-out animation
          setTimeout(() => {
            setDeleteMessage(''); // Clear the message after animation
            setFadeOut(false); // Reset fade-out state
          }, 2000); // Match this duration with the CSS transition duration
        }, 3000);
        // Force re-render of ProductCartUserTrackerApp
        setComponentKey(prevKey => prevKey + 1);
      } catch (error) {
        console.error('Error deleting user:', error);
      } finally {
        setDeleteLoading(false);
        setDeletingUserId(null);
      }
    }
  };
  function formatDate(dateString) {
    const date = new Date(dateString);
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    const seconds = String(date.getSeconds()).padStart(2, '0');
    return `D:${day}-${month}-${year}  T:${hours}:${minutes}:${seconds}`;
  }
  const selectedItem = data.find(item => item.user_id === selectedUserId);
  const [showMainContent, setShowMainContent] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(true);
  const toggleMainContent = () => {
    setShowMainContent(!showMainContent);
  };

  // page reload
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useEffect)(() => {
    fetchData();
  }, []);
  const reload = () => {
    setLoading(true); // Optionally show loading state
    fetchData(); // Fetch data again
  };

  // Cart Analytics 
  // ===== Dashboard Stats (Derived safely from existing data) =====

  const activeCarts = data.length;
  const itemsTracked = data.reduce((sum, item) => {
    return sum + Number(item.total_quantity || 0);
  }, 0);
  const guestUsers = data.filter(item => !item.user_login).length;

  // Simple derived abandoned rate (safe placeholder logic)
  const abandonedRate = activeCarts ? (guestUsers / activeCarts * 100).toFixed(1) : 0;
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, showMainContent && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-cart-track-content"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h2", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-stats-grid"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-stat-card"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-stat-icon blue"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
    xmlns: "http://www.w3.org/2000/svg",
    width: "20",
    height: "20",
    viewBox: "0 0 24 24",
    fill: "none",
    stroke: "currentColor",
    "stroke-width": "2",
    "stroke-linecap": "round",
    "stroke-linejoin": "round",
    class: "lucide lucide-shopping-bag",
    "aria-hidden": "true"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M16 10a4 4 0 0 1-8 0"
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M3.103 6.034h17.794"
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"
  }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-stat-value"
  }, activeCarts), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-stat-label"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Active Users', 'taiowc'))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-stat-card"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-stat-icon green"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
    xmlns: "http://www.w3.org/2000/svg",
    width: "20",
    height: "20",
    viewBox: "0 0 24 24",
    fill: "none",
    stroke: "currentColor",
    "stroke-width": "2",
    "stroke-linecap": "round",
    "stroke-linejoin": "round",
    class: "lucide lucide-activity",
    "aria-hidden": "true"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M22 12h-2.48a2 2 0 0 0-1.93 1.46l-2.35 8.36a.25.25 0 0 1-.48 0L9.24 2.18a.25.25 0 0 0-.48 0l-2.35 8.36A2 2 0 0 1 4.49 12H2"
  }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-stat-value"
  }, itemsTracked), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-stat-label"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Total Prducts', 'taiowc'))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-stat-card"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-stat-icon yellow"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
    xmlns: "http://www.w3.org/2000/svg",
    width: "20",
    height: "20",
    viewBox: "0 0 24 24",
    fill: "none",
    stroke: "currentColor",
    "stroke-width": "2",
    "stroke-linecap": "round",
    "stroke-linejoin": "round",
    class: "lucide lucide-zap",
    "aria-hidden": "true"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"
  }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-stat-value"
  }, abandonedRate, "%"), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-stat-label"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Abandoned Rate', 'taiowc'))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-stat-card"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-stat-icon purple"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
    xmlns: "http://www.w3.org/2000/svg",
    width: "20",
    height: "20",
    viewBox: "0 0 24 24",
    fill: "none",
    stroke: "currentColor",
    "stroke-width": "2",
    "stroke-linecap": "round",
    "stroke-linejoin": "round",
    class: "lucide lucide-users",
    "aria-hidden": "true"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M16 3.128a4 4 0 0 1 0 7.744"
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M22 21v-2a4 4 0 0 0-3-3.87"
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("circle", {
    cx: "9",
    cy: "7",
    r: "4"
  }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-stat-value"
  }, guestUsers), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-stat-label"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Guests Users', 'taiowc')))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
    xmlns: "http://www.w3.org/2000/svg",
    width: "18",
    height: "18",
    viewBox: "0 0 24 24",
    fill: "none",
    stroke: "currentColor",
    "stroke-width": "2",
    "stroke-linecap": "round",
    "stroke-linejoin": "round",
    class: "lucide lucide-users text-blue-500",
    "aria-hidden": "true"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M16 3.128a4 4 0 0 1 0 7.744"
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M22 21v-2a4 4 0 0 0-3-3.87"
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("circle", {
    cx: "9",
    cy: "7",
    r: "4"
  })), (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Active Customer Sessions', 'taiowc')), selectedUserId && selectedItem ? userDataLoading ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, "Loading...") // Show user details loading indicator
  : (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "taiowc-cart-user-head"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "taiowc-cart-user-head-left"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('User Name :', 'taiowc'), " ", selectedItem.user_login ? selectedItem.user_login : 'Guest#' + selectedItem.user_id), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h5", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Email :', 'taiowc'), " ", selectedItem.user_email ? selectedItem.user_email : "unknown")), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: "user-back",
    onClick: () => handleUserBackClick()
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "dashicons dashicons-arrow-left-alt"
  }), (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Back', 'taiowc'))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("table", {
    className: "wp-list-table taiowc-user-product widefat fixed striped table-view-list"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("thead", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("th", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Product in Cart', 'taiowc')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("th", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Quantity', 'taiowc')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("th", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Remove', 'taiowc')))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("tbody", null, currentCartItems.map((user, index) => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", {
    className: "th-product-list",
    key: index
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", {
    className: "th-product-title"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("img", {
    src: user.image_url,
    alt: user.name
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
    href: user.product_link
  }, user.name)), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", {
    className: "th-product-quantity"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "units"
  }, user.quantity)), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", {
    className: "th-product-remove"
  }, user.product_remove))))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_cart_pagination_js__WEBPACK_IMPORTED_MODULE_5__["default"], {
    currentPage: currentCartPage,
    totalPages: totalCartPages,
    onPageChange: handleCartPageChange
  }))) : (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-notice"
  }, deleteMessage && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: `th-delete-message ${fadeOut ? 'fade-out' : ''}`
  }, deleteMessage) // Display the delete message
  ), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: "reload-btn",
    onClick: reload
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "dashicons dashicons-image-rotate"
  })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("table", {
    className: "wp-list-table widefat fixed striped table-view-list"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("thead", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("th", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Username', 'taiowc')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("th", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Product in cart', 'taiowc')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("th", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Last update', 'taiowc')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("th", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Cart Action', 'taiowc')))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("tbody", null, loading ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", {
    colSpan: "4"
  }, "Loading...")) : currentItems.length === 0 ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", {
    colSpan: "4"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('No record', 'taiowc'))) : currentItems.map((item, index) => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", {
    key: index
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, item.user_login ? item.user_login : 'Guest#' + item.user_id), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "units"
  }, item.total_quantity)), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, formatDate(item.updated_date)), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: "th-view",
    onClick: () => handleUserViewClick(item.user_id)
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "dashicons dashicons-visibility"
  })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "th-seprator"
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: "th-delete",
    onClick: () => deleteUser(item.user_id),
    disabled: deleteLoading && deletingUserId === item.user_id
  }, deleteLoading && deletingUserId === item.user_id ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "dashicons dashicons-update"
  }) // Loading icon
  : (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
    xmlns: "http://www.w3.org/2000/svg",
    width: "18",
    height: "18",
    viewBox: "0 0 24 24",
    fill: "none",
    stroke: "currentColor",
    "stroke-width": "2",
    "stroke-linecap": "round",
    "stroke-linejoin": "round",
    class: "lucide lucide-trash2 lucide-trash-2",
    "aria-hidden": "true"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M10 11v6"
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M14 11v6"
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M3 6h18"
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
  })))))))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_cart_pagination_js__WEBPACK_IMPORTED_MODULE_5__["default"], {
    currentPage: currentPage,
    totalPages: totalPages,
    onPageChange: handleProductPageChange
  }))), !selectedUserId && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_product_cart_user_table_js__WEBPACK_IMPORTED_MODULE_4__["default"], {
    key: componentKey,
    toggleMainContent: toggleMainContent
  }));
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (StatusTrackerApp);

/***/ }),

/***/ "./src/cart-track/product-cart-user-table.js":
/*!***************************************************!*\
  !*** ./src/cart-track/product-cart-user-table.js ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/api-fetch */ "@wordpress/api-fetch");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _cart_pagination_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./cart-pagination.js */ "./src/cart-track/cart-pagination.js");





function ProductCartUserTrackerApp({
  key,
  toggleMainContent
}) {
  const [data, setData] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)([]);
  const [loading, setLoading] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(true);
  const [selectedProductName, setSelectedProductName] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(null);
  const [userDetails, setUserDetails] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)([]);
  const [userDataLoading, setUserDataLoading] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(false);

  // Pagination states for product list
  const [currentPage, setCurrentPage] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(1);
  const itemsPerPage = 10;

  // Pagination states for user details
  const [currentUserPage, setCurrentUserPage] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(1);
  const itemsUserPerPage = 10;

  // useEffect(() => {
  //     apiFetch({ path: 'taiowc/v1/productusercart' })
  //         .then((response) => {
  //             setData(response);
  //             setLoading(false);
  //         })
  //         .catch((error) => {
  //             console.error('Error fetching data:', error);
  //             setLoading(false);
  //         });
  // }, [key]);

  const fetchData = () => {
    _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2___default()({
      path: 'taiowc/v1/productusercart'
    }).then(response => {
      setData(response);
      setLoading(false);
    }).catch(error => {
      console.error('Error fetching data:', error);
      setLoading(false);
    });
  };

  // page reload
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useEffect)(() => {
    fetchData();
  }, [key]);
  const reload = () => {
    setLoading(true); // Optionally show loading state
    fetchData(); // Fetch data again
  };

  const handleUserViewClick = (productId, productName) => {
    setSelectedProductName(productName);
    setUserDataLoading(true);
    getUserDetails(productId);
    toggleMainContent(true);
  };
  const handleUserBackClick = () => {
    setSelectedProductName(null);
    setUserDetails([]); // Clear user details
    setUserDataLoading(false);
    setCurrentUserPage(1); // Reset user pagination
    toggleMainContent(false);
  };
  const getUserDetails = async productId => {
    try {
      const response = await _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_2___default()({
        path: `taiowc/v1/productuser/${productId}`
      });
      setUserDetails(response);
    } catch (error) {
      console.error('Error fetching user details:', error);
    } finally {
      setUserDataLoading(false);
    }
  };
  const selectedItem = data.find(item => item.name === selectedProductName);

  // Pagination logic for product list
  const indexOfLastItem = currentPage * itemsPerPage;
  const indexOfFirstItem = indexOfLastItem - itemsPerPage;
  const currentItems = data.slice(indexOfFirstItem, indexOfLastItem);
  const totalPages = Math.ceil(data.length / itemsPerPage);
  const handleProductPageChange = pageNumber => {
    setCurrentPage(pageNumber);
  };

  // Pagination logic for user details
  const indexOfLastUserItem = currentUserPage * itemsUserPerPage;
  const indexOfFirstUserItem = indexOfLastUserItem - itemsUserPerPage;
  const currentUserItems = userDetails.slice(indexOfFirstUserItem, indexOfLastUserItem);
  const totalUserPages = Math.ceil(userDetails.length / itemsUserPerPage);
  const handleUserPageChange = pageNumber => {
    setCurrentUserPage(pageNumber);
  };
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-product-cart-content"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h2", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
    xmlns: "http://www.w3.org/2000/svg",
    width: "18",
    height: "18",
    viewBox: "0 0 24 24",
    fill: "none",
    stroke: "currentColor",
    "stroke-width": "2",
    "stroke-linecap": "round",
    "stroke-linejoin": "round",
    class: "lucide lucide-zap text-amber-500",
    "aria-hidden": "true"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"
  })), "           ", (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Product Performance (Most Wanted)', 'taiowc')), selectedProductName && selectedItem ? userDataLoading ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, "Loading...") // Show user details loading indicator
  : (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "taiowc-cart-user-head"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Product Name :', 'taiowc'), " ", selectedItem.name), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: "user-back",
    onClick: handleUserBackClick
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "dashicons dashicons-arrow-left-alt"
  }), (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Back', 'taiowc'))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("table", {
    className: "wp-list-table taiowc-user-product widefat fixed striped table-view-list"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("thead", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("th", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('User Name', 'taiowc')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("th", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Email/IP', 'taiowc')))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("tbody", null, currentUserItems.map((item, index) => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", {
    className: "th-product-list",
    key: index
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, item.user_login ? item.user_login : 'Guest#' + item.user_id), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, item.user_email ? item.user_email : item.ip_address))))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_cart_pagination_js__WEBPACK_IMPORTED_MODULE_4__["default"], {
    currentPage: currentUserPage,
    totalPages: totalUserPages,
    onPageChange: handleUserPageChange
  })) : (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: "reload-btn",
    onClick: reload
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "dashicons dashicons-image-rotate"
  })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("table", {
    className: "wp-list-table taiowc-user-product th-product-user widefat fixed striped table-view-list"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("thead", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("th", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Product Name', 'taiowc')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("th", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Total User', 'taiowc')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("th", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Status', 'taiowc')))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("tbody", null, loading ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", {
    colSpan: "3"
  }, "Loading...")) : currentItems.length === 0 ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", {
    colSpan: "3"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('No record', 'taiowc'))) : currentItems.map((item, index) => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", {
    key: index
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", {
    className: "th-product-title"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-image"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("img", {
    src: item.image_url,
    alt: item.name
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
    href: item.product_link
  }, item.name))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "units"
  }, item.total_user)), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: "th-view",
    onClick: () => handleUserViewClick(item.product_id, item.name)
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "dashicons dashicons-visibility"
  }))))))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_cart_pagination_js__WEBPACK_IMPORTED_MODULE_4__["default"], {
    currentPage: currentPage,
    totalPages: totalPages,
    onPageChange: handleProductPageChange
  })));
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (ProductCartUserTrackerApp);

/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

module.exports = window["React"];

/***/ }),

/***/ "@wordpress/api-fetch":
/*!**********************************!*\
  !*** external ["wp","apiFetch"] ***!
  \**********************************/
/***/ ((module) => {

module.exports = window["wp"]["apiFetch"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ ((module) => {

module.exports = window["wp"]["element"];

/***/ }),

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/***/ ((module) => {

module.exports = window["wp"]["i18n"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!*********************************!*\
  !*** ./src/cart-track/index.js ***!
  \*********************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/api-fetch */ "@wordpress/api-fetch");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _cart_table_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./cart-table.js */ "./src/cart-track/cart-table.js");
/* harmony import */ var _ExportPerformancePanel__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./ExportPerformancePanel */ "./src/cart-track/ExportPerformancePanel.js");






function CartTrackPanel() {
  const [isTrackSystemEnabled, setIsTrackSystemEnabled] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(true); // default to true
  const [isLoading, setIsLoading] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useState)(true);
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.useEffect)(() => {
    _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3___default()({
      path: '/taiowc/v1/taiowc-track-system-enabled'
    }).then(data => {
      setIsTrackSystemEnabled(data);
      setIsLoading(false);
    }).catch(error => {
      console.error('Error fetching track system status:', error);
      setIsLoading(false);
    });
  }, []);
  const handleCheckboxChange = event => {
    const isChecked = event.target.checked;
    setIsTrackSystemEnabled(isChecked);
    _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_3___default()({
      path: '/taiowc/v1/taiowc-track-system-enabled',
      method: 'POST',
      data: {
        enabled: isChecked
      }
    }).then(data => {
      if (!data) {
        alert((0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Error saving settings', 'taiowc'));
      }
    }).catch(error => {
      console.error('Error saving track system status:', error);
      alert((0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Error saving settings', 'taiowc'));
    });
  };
  if (isLoading) {
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Loading...', 'taiowc'));
  }
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-cart-track-wrap"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-track-card"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-track-left"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-track-icon"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
    xmlns: "http://www.w3.org/2000/svg",
    width: "32",
    height: "32",
    viewBox: "0 0 24 24",
    fill: "none",
    stroke: "currentColor",
    "stroke-width": "2",
    "stroke-linecap": "round",
    "stroke-linejoin": "round",
    class: "lucide lucide-shield-check",
    "aria-hidden": "true"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
    d: "m9 12 2 2 4-4"
  }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "th-track-text"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", null, "Tracking Analytics Status"), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, "Global session tracking is currently active and recording. Ensure this is enabled for analytics."))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    className: "th-toggle-switch"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "th-toggle-label off"
  }, "Analytics DISABLED"), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "checkbox",
    checked: isTrackSystemEnabled,
    onChange: handleCheckboxChange
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "th-toggle-slider"
  }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "th-toggle-label on"
  }, "Analytics ACTIVE"))), isTrackSystemEnabled && (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_cart_table_js__WEBPACK_IMPORTED_MODULE_4__["default"], null), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_ExportPerformancePanel__WEBPACK_IMPORTED_MODULE_5__["default"], null));
}
const container = document.getElementById('taiowc-track-root');
if (container) {
  // Use createRoot to create a root instance and then render the component
  const root = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createRoot)(container);
  root.render((0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(CartTrackPanel, null));
}
})();

/******/ })()
;
//# sourceMappingURL=taiowc-cart-track.js.map