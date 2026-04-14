import { useState, useEffect } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';
import { __ } from '@wordpress/i18n';
import ProductCartUserTrackerApp from './product-cart-user-table.js';
import CartPagination from './cart-pagination.js';

function StatusTrackerApp() {
    const [data, setData] = useState([]);
    const [loading, setLoading] = useState(true);
    const [userDataLoading, setUserDataLoading] = useState(false); 
    const [selectedUserId, setSelectedUserId] = useState(null);
    const [userDetails, setUserDetails] = useState([]);
    const [componentKey, setComponentKey] = useState(0);

    const handleUserViewClick = (userId) => {
        getUserDetails(userId);
        setSelectedUserId(userId);
        setUserDataLoading(true);
    }

    const handleUserBackClick = () => {
        setSelectedUserId(null);
        setUserDataLoading(false);
    };

    const getUserDetails = async (userId) => {
        try {
          const response = await apiFetch({ path: `taiowc/v1/user/${userId}` });
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
      apiFetch({ path: 'taiowc/v1/usercart' })
          .then((response) => {
              setData(response);
              setLoading(false);
          })
          .catch((error) => {
              console.error('Error fetching data:', error);
              setLoading(false);
          });
  };

    // Pagination states
    const [currentPage, setCurrentPage] = useState(1);
    const itemsPerPage = 10;
    const indexOfLastItem = currentPage * itemsPerPage;
    const indexOfFirstItem = indexOfLastItem - itemsPerPage;
    const currentItems = data.slice(indexOfFirstItem, indexOfLastItem);
    const totalPages = Math.ceil(data.length / itemsPerPage);

    const handleProductPageChange = (pageNumber) => {
        setCurrentPage(pageNumber);
    };

    // Pagination cart states
    const [currentCartPage, setCurrentCartPage] = useState(1);
    const itemsCartPerPage = 10;
    const indexOfLastCartItem = currentCartPage * itemsCartPerPage;
    const indexOfCartFirstItem = indexOfLastCartItem - itemsCartPerPage;
    const currentCartItems = userDetails.slice(indexOfCartFirstItem, indexOfLastCartItem);
    const totalCartPages = Math.ceil(userDetails.length / itemsCartPerPage);

    const handleCartPageChange = (pageCartNumber) => {
        setCurrentCartPage(pageCartNumber);
    };
   // delete user and product record
   const [deleteLoading, setDeleteLoading] = useState(false);
   const [deletingUserId, setDeletingUserId] = useState(null);
   const [deleteMessage, setDeleteMessage] = useState('');
   const [fadeOut, setFadeOut] = useState(false); 
   const deleteUser = async (userId) => {
        
        if (window.confirm(__('Are you sure you want to delete this user?', 'taiowc'))) {
            setDeleteLoading(true); // Set delete loading to true
            setDeletingUserId(userId);
            try {
              const response = await apiFetch({
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
    const [showMainContent, setShowMainContent] = useState(true);
    const toggleMainContent = () => {
      setShowMainContent(!showMainContent);
    };

    // page reload
    useEffect(() => {
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
const abandonedRate = activeCarts
  ? ((guestUsers / activeCarts) * 100).toFixed(1)
  : 0;


    return (
        <>
       {showMainContent && (
         <div className='th-cart-track-content'>
         <h2>

          <div className="th-stats-grid">

  <div className="th-stat-card">
    <div className="th-stat-icon blue"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag" aria-hidden="true"><path d="M16 10a4 4 0 0 1-8 0"></path><path d="M3.103 6.034h17.794"></path><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path></svg></div>
    <div className="th-stat-value">{activeCarts}</div>
    <div className="th-stat-label">{__('Active Users', 'taiowc')}</div>
  </div>

  <div className="th-stat-card">
    <div className="th-stat-icon green"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-activity" aria-hidden="true"><path d="M22 12h-2.48a2 2 0 0 0-1.93 1.46l-2.35 8.36a.25.25 0 0 1-.48 0L9.24 2.18a.25.25 0 0 0-.48 0l-2.35 8.36A2 2 0 0 1 4.49 12H2"></path></svg></div>
    <div className="th-stat-value">{itemsTracked}</div>
    <div className="th-stat-label">{__('Total Prducts', 'taiowc')}</div>
  </div>

  <div className="th-stat-card">
    <div className="th-stat-icon yellow"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-zap" aria-hidden="true"><path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"></path></svg></div>
    <div className="th-stat-value">{abandonedRate}%</div>
    <div className="th-stat-label">{__('Abandoned Rate', 'taiowc')}</div>
  </div>

  <div className="th-stat-card">
    <div className="th-stat-icon purple"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><path d="M16 3.128a4 4 0 0 1 0 7.744"></path><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><circle cx="9" cy="7" r="4"></circle></svg></div>
    <div className="th-stat-value">{guestUsers}</div>
    <div className="th-stat-label">{__('Guests Users', 'taiowc')}</div>
  </div>

</div>


          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users text-blue-500" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><path d="M16 3.128a4 4 0 0 1 0 7.744"></path><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><circle cx="9" cy="7" r="4"></circle></svg>
          {__('Active Customer Sessions', 'taiowc')}</h2>
          {selectedUserId && selectedItem  ? (
                userDataLoading ? (
                    <div>Loading...</div> // Show user details loading indicator
                ) : (
            <>
            <div className="taiowc-cart-user-head">
            <div className="taiowc-cart-user-head-left">
            <h4>{__('User Name :', 'taiowc')} {selectedItem.user_login ? selectedItem.user_login : 'Guest#'+selectedItem.user_id}</h4>
            <h5>{__('Email :', 'taiowc')} {selectedItem.user_email ? selectedItem.user_email : "unknown"}</h5>
            </div>  
            <button className="user-back" onClick={() => handleUserBackClick()}>
            <span className="dashicons dashicons-arrow-left-alt"></span>{__('Back', 'taiowc')}
            </button>
            </div>
            <>    
            <table className="wp-list-table taiowc-user-product widefat fixed striped table-view-list">
            <thead>
              <tr>
                <th>{__('Product in Cart', 'taiowc')}</th>
                <th>{__('Quantity', 'taiowc')}</th>
                <th>{__('Remove', 'taiowc')}</th>
              </tr>
            </thead>
            <tbody>
            {currentCartItems.map((user, index) => (
              <tr className="th-product-list" key={index}>
                <td className="th-product-title">
                <img src={user.image_url} alt={user.name}></img>
                <a href={user.product_link}>{user.name}</a>
                </td>
                <td className="th-product-quantity"><span className='units'>{user.quantity}</span></td>
                <td className="th-product-remove">{user.product_remove}</td>
              </tr>
            ))}
            </tbody>
          </table>
          <CartPagination
          currentPage={currentCartPage}
          totalPages={totalCartPages}
          onPageChange={handleCartPageChange}
           />
           </>
            
          </>
          )
        ) : (
         <>
         <div className='th-notice'>
          {deleteMessage && (
          <div className={`th-delete-message ${fadeOut ? 'fade-out' : ''}`}>{deleteMessage}</div> // Display the delete message
          )}
          </div>
          <button className="reload-btn" onClick={reload}><span className="dashicons dashicons-image-rotate"></span></button>
          <table className="wp-list-table widefat fixed striped table-view-list">
            <thead>
              <tr>
                <th>{__('Username', 'taiowc')}</th>
                <th>{__('Product in cart', 'taiowc')}</th>
                <th>{__('Last update', 'taiowc')}</th>
                <th>{__('Cart Action', 'taiowc')}</th>
              </tr>
            </thead>
            <tbody>
              
              {loading ? (
                            <tr>
                                <td colSpan="4">Loading...</td>
                            </tr>
                        ) : ( 
                currentItems.length === 0 ? (
                            <tr>
                                <td colSpan="4">{__('No record', 'taiowc')}</td>
                            </tr>
                ) : (       
                currentItems.map((item, index) => (
                <tr key={index}>
                  <td>{item.user_login ? item.user_login : 'Guest#'+item.user_id }</td>
                  <td><span className='units'>{item.total_quantity}</span></td>
                  <td>{formatDate(item.updated_date)}</td>
                  <td>
                    <button className="th-view" onClick={() => handleUserViewClick(item.user_id)}>
                    <span className="dashicons dashicons-visibility"></span>
                    </button>
                    <span className="th-seprator"></span>
                    <button className="th-delete" onClick={() => deleteUser(item.user_id)} disabled={deleteLoading && deletingUserId === item.user_id}>
                    {deleteLoading && deletingUserId === item.user_id ? (
                        <span className="dashicons dashicons-update"></span> // Loading icon
                    ) : (
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2 lucide-trash-2" aria-hidden="true"><path d="M10 11v6"></path><path d="M14 11v6"></path><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"></path><path d="M3 6h18"></path><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                    )}
                  </button>
                  </td>
                </tr>
              )))
              )}
            </tbody>
          </table>
          <CartPagination
          currentPage={currentPage}
          totalPages={totalPages}
          onPageChange={handleProductPageChange}
         />
         </>
          )}
          </div> 
         )}
          {!selectedUserId && <ProductCartUserTrackerApp key={componentKey} toggleMainContent={toggleMainContent} />}
        </>
    );
}
export default StatusTrackerApp;