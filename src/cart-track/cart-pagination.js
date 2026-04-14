import { __ } from '@wordpress/i18n';

function CartPagination({ currentPage, totalPages, onPageChange }) {
    if (totalPages <= 1) return null;

    const handleClick = (page) => {
        if (page >= 1 && page <= totalPages) {
            onPageChange(page);
        }
    };

    return (
        <div className="th-pagination">
            <button  className="th-prev" onClick={() => handleClick(currentPage - 1)} disabled={currentPage === 1}>
            <span className="dashicons dashicons-arrow-left-alt"></span> {__('Prev', 'taiowc')}
            </button>
            {[...Array(totalPages)].map((_, index) => (
                <button
                    key={index}
                    onClick={() => handleClick(index + 1)}
                    className={currentPage === index + 1 ? 'active' : ''}
                >
                    {index + 1}
                </button>
            ))}
            <button className="th-next" onClick={() => handleClick(currentPage + 1)} disabled={currentPage === totalPages}>
            {__('Next', 'taiowc')} <span className="dashicons dashicons-arrow-right-alt"></span>
            </button>
        </div>
    );
}
export default CartPagination;
