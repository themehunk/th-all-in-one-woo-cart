// ExportPerformancePanel.js
import { __ } from '@wordpress/i18n';
import apiFetch from '@wordpress/api-fetch';

export default function ExportPerformancePanel() {

  const downloadFile = async (format) => {
    try {
      const response = await apiFetch({
        path: `/taiowc/v1/export?format=${format}`,
        method: 'GET',
        parse: false, // IMPORTANT for file download
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
      alert(__('Failed to export data', 'taiowc'));
    }
  };

  return (
    <div className="th-export-card">

      <div className="th-export-left">
        <h3>{__('Export Performance Data', 'taiowc')}</h3>
        <p>
          {__(
            'Download current session datasets in high-fidelity formats for business intelligence and external reporting.',
            'taiowc'
          )}
        </p>
      </div>

      <div className="th-export-actions">
        <button
          className="th-export-btn"
          onClick={() => downloadFile('csv')}
        >
          ↓ CSV FORMAT
        </button>

        <button
          className="th-export-btn secondary"
          onClick={() => downloadFile('json')}
        >
          ↓ JSON DATA
        </button>
      </div>

    </div>
  );
}
