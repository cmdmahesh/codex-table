import React from 'react';
import ReactDOM from 'react-dom';
	
import 'bootstrap/dist/css/bootstrap.min.css';


import AdminMenuTabs from './component/AdminMenuTabs';



class SP_Table extends React.Component{

	render() {
		return (
			<>
				<h1>WooCommerce Product Data Table</h1>
				<hr/>
				<AdminMenuTabs/>
			</>
		);
	}
}
ReactDOM.render(<SP_Table/>,document.getElementById('sp-table-container'));
