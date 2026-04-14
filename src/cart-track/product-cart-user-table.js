import { useState, useEffect } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';
import { __ } from '@wordpress/i18n';
import CartPagination from './cart-pagination.js';

function ProductCartUserTrackerApp({key,toggleMainContent}) {
    const [data, setData] = useState([]);
    const [loading, setLoading] = useState(true);
    const [selectedProductName, setSelectedProductName] = useState(null);
    const [userDetails, setUserDetails] = useState([]);
    const [userDataLoading, setUserDataLoading] = useState(false);

    // Pagination states for product list
    const [currentPage, setCurrentPage] = useState(1);
    const itemsPerPage = 10;

    // Pagination states for user details
    const [currentUserPage, setCurrentUserPage] = useState(1);
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
        apiFetch({ path: 'taiowc/v1/productusercart' })
            .then((response) => {
                setData(response);
                setLoading(false);
            })
            .catch((error) => {
                console.error('Error fetching data:', error);
                setLoading(false);
            });
    };

    // page reload
    useEffect(() => {
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

    const getUserDetails = async (productId) => {
        try {
            const response = await apiFetch({ path: `taiowc/v1/productuser/${productId}` });
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

    const handleProductPageChange = (pageNumber) => {
        setCurrentPage(pageNumber);
    };

    // Pagination logic for user details
    const indexOfLastUserItem = currentUserPage * itemsUserPerPage;
    const indexOfFirstUserItem = indexOfLastUserItem - itemsUserPerPage;
    const currentUserItems = userDetails.slice(indexOfFirstUserItem, indexOfLastUserItem);
    const totalUserPages = Math.ceil(userDetails.length / itemsUserPerPage);

    const handleUserPageChange = (pageNumber) => {
        setCurrentUserPage(pageNumber);
    };

    return (
        <div className='th-product-cart-content'>
            <h2>
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-zap text-amber-500" aria-hidden="true"><path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"></path></svg>           {__('Product Performance (Most Wanted)', 'taiowc')}</h2>
            {selectedProductName && selectedItem ? (
                userDataLoading ? (
                    <div>Loading...</div> // Show user details loading indicator
                ) : (
                    <>
                        <div className="taiowc-cart-user-head">
                            <h4>{__('Product Name :', 'taiowc')} {selectedItem.name}</h4>
                            <button className="user-back" onClick={handleUserBackClick}>
                                <span className="dashicons dashicons-arrow-left-alt"></span>{__('Back', 'taiowc')}
                            </button>
                        </div>
                        <table className="wp-list-table taiowc-user-product widefat fixed striped table-view-list">
                            <thead>
                                <tr>
                                    <th>{__('User Name', 'taiowc')}</th>
                                    <th>{__('Email/IP', 'taiowc')}</th>
                                    {/* <th>{__('Server Request', 'taiowc')}</th> */}
                                </tr>
                            </thead>
                            <tbody>
                                {currentUserItems.map((item, index) => (
                                    <tr className="th-product-list" key={index}>
                                        <td>{item.user_login ? item.user_login : 'Guest#'+item.user_id}</td>
                                        <td>{item.user_email ? item.user_email : item.ip_address}</td>
                                        {/* <td>{item.server_request}</td> */}
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                        <CartPagination
                            currentPage={currentUserPage}
                            totalPages={totalUserPages}
                            onPageChange={handleUserPageChange}
                        />
                    </>
                )
                ) : (
                <>
                <button className="reload-btn" onClick={reload}><span className="dashicons dashicons-image-rotate"></span></button>
                    <table className="wp-list-table taiowc-user-product th-product-user widefat fixed striped table-view-list">
                        <thead>
                            <tr>
                                <th>{__('Product Name', 'taiowc')}</th>
                                <th>{__('Total User', 'taiowc')}</th>
                                <th>{__('Status', 'taiowc')}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {loading ? (
                                <tr>
                                    <td colSpan="3">Loading...</td>
                                </tr>
                            ) : (
                                currentItems.length === 0 ? (
                                    <tr>
                                        <td colSpan="3">{__('No record', 'taiowc')}</td>
                                    </tr>
                                ) : (  
                                currentItems.map((item, index) => (
                                    <tr key={index}>
                                        <td className="th-product-title">
                                            <div className='th-image'>
                                            <img src={item.image_url} alt={item.name}></img>
                                            <a href={item.product_link}>{item.name}</a>
                                            </div>
                                        </td>
                                        <td><span className='units'>{item.total_user}</span></td>
                                        <td>
                                            <button className="th-view" onClick={() => handleUserViewClick(item.product_id, item.name)}>
                                                <span className="dashicons dashicons-visibility"></span>
                                            </button>
                                        </td>
                                    </tr>
                                ))
                            ))}
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
    );
}

export default ProductCartUserTrackerApp;
