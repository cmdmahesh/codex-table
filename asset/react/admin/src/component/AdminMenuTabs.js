import React from 'react';
import Tabs from 'react-bootstrap/Tabs';
import Tab from 'react-bootstrap/Tab';
import AdminProductGrid from './AdminProductGrid'
class AdminMenuTabs extends React.Component{

	render() {
		return(<Tabs defaultActiveKey="editor" id="uncontrolled-tab-example" className="mb-3">
            <Tab eventKey="editor" title="Visual Editor">
              <hr/>
              <h5> Visual Table Editor.... </h5>
              <AdminProductGrid/>
            </Tab>
            <Tab eventKey="setting" title="Settings">
              <h1>Basic tuning</h1>
            </Tab>
            <Tab eventKey="contact" title="Contact">
              <h1> Contact the dev </h1>
            </Tab>
          </Tabs>);
	}
}

export default AdminMenuTabs;
