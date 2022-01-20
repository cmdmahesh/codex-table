import React from 'react';
import Tabs from 'react-bootstrap/Tabs';
import Tab from 'react-bootstrap/Tab';
import PublicProductGrid from './../../../lib/grid/PublicProductGrid';
import AddColumnForm from './AddColumnForm';

class AdminProductGrid extends React.Component{

	render() {
        
        let rows = [];
        let columns = [];
        return (<AddColumnForm/>);
		//return(<PublicProductGrid row={rows} columns={columns} />);
	}
}

export default AdminProductGrid;
