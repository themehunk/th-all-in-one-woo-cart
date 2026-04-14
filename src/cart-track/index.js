import { createRoot , useState, useEffect } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import apiFetch from '@wordpress/api-fetch';
import StatusTrackerApp from './cart-table.js';
import ExportPerformancePanel from './ExportPerformancePanel';



function CartTrackPanel(){

    const [isTrackSystemEnabled, setIsTrackSystemEnabled] = useState(true); // default to true
    const [isLoading, setIsLoading] = useState(true);

    useEffect(() => {
        apiFetch({ path: '/taiowc/v1/taiowc-track-system-enabled' })
            .then(data => {
                setIsTrackSystemEnabled(data);
                setIsLoading(false);
            })
            .catch(error => {
                console.error('Error fetching track system status:', error);
                setIsLoading(false);
            });
    }, []);

    const handleCheckboxChange = (event) => {
        const isChecked = event.target.checked;
        setIsTrackSystemEnabled(isChecked);

        apiFetch({
            path: '/taiowc/v1/taiowc-track-system-enabled',
            method: 'POST',
            data: { enabled: isChecked }
        }).then(data => {
            if (!data) {
                alert(__('Error saving settings', 'taiowc'));
            }
        }).catch(error => {
            console.error('Error saving track system status:', error);
            alert(__('Error saving settings', 'taiowc'));
        });
    };

    if (isLoading) {
        return <div>{__('Loading...', 'taiowc')}</div>;
    }

    return (
        <div className='th-cart-track-wrap'>
             <div className="th-track-card">

    {/* LEFT CONTENT */}
    <div className="th-track-left">
      <div className="th-track-icon"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check" aria-hidden="true"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path><path d="m9 12 2 2 4-4"></path></svg></div>

      <div className="th-track-text">
        <h3>Tracking Analytics Status</h3>
        <p>
          Global session tracking is currently active and recording.
          Ensure this is enabled for analytics.
        </p>
      </div>
    </div>

    {/* RIGHT TOGGLE */}
    <label className="th-toggle-switch">
      <span className="th-toggle-label off">Analytics DISABLED</span>

      <input
        type="checkbox"
        checked={isTrackSystemEnabled}
        onChange={handleCheckboxChange}
      />

      <span className="th-toggle-slider"></span>

      <span className="th-toggle-label on">Analytics ACTIVE</span>
    </label>

  </div>

  {/* CONDITIONAL CONTENT */}
    {isTrackSystemEnabled && <StatusTrackerApp />}

      {/* 🔽 NEW EXPORT PANEL */}
  <ExportPerformancePanel />
        </div>
    )
}
const container = document.getElementById('taiowc-track-root');
if (container) {
  // Use createRoot to create a root instance and then render the component
  const root = createRoot(container);
  root.render(<CartTrackPanel />);

}