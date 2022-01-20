import React from 'react';
import {Button,Modal,Form,InputGroup,ButtonGroup,ToggleButton} from 'react-bootstrap';

class AddColumnForm extends React.Component{

    constructor(props) {
        super(props);
        this.state = {
            show_form: false,
            column_feed_type:'category',
            _category:false,
            _attribute:false,
            _meta:[
                { key:'__name', label:'Name' },
                { key:'__price', label:'Price' },
                { key:'__thumb', label:'Image' },
                { key:'__link', label:'Link' }
            ],
            _data_types:[
                { key:'text', label:'Text Only' },
                { key:'text_image', label:'Text & Image' },
                { key:'image_text', label:'Image & Text' },
                { key:'image', label:'Image Only' }
            ]
        };
        this.handle_show = this.handle_show.bind(this);
        this.handle_field_selected = this.handle_field_selected.bind(this);
    }
    
    handle_show(status) {
        let form_state = {};
        form_state['show_form'] = status;
        this.setState(form_state);
    }  

    handle_field_selected(field_type) {
        let form_state = {};
        form_state['column_feed_type'] = field_type;
        this.setState(form_state);
    }

    handle_add() {

    }

    componentDidMount() {
        
    }

	render() {
        const handleClose = () => this.handle_show(false);
        const handleShow = () => this.handle_show(true);


        const form_field_type = [
            {label:'Category',value:'category'},
            {label:'Attribute',value:'attribute'},
            {label:'Meta',value:'meta'}
        ];
       
        return(<>
            <Button variant="primary" onClick={handleShow}>+</Button>      
            <Modal show={this.state.show_form} onHide={handleClose} backdrop="static" keyboard={false} >
                <Modal.Header closeButton>
                    <Modal.Title>Add Column</Modal.Title>
                </Modal.Header>
                <Modal.Body>                
                    <Form>
                        <Form.Group className="mb-3" controlId="column_label">
                            <Form.Label>Label</Form.Label>
                            <Form.Control type="text" placeholder="Column Label"/>
                            <Form.Text className="text-muted"> Column label on the table. </Form.Text>
                        </Form.Group>
                                              
                        <Form.Group className="mb-3" controlId="column_field_type">
                            <Form.Label>Select Field Type</Form.Label>
                            <br />
                            <ButtonGroup>
                                {form_field_type.map((field_type, index) => (
                                <ToggleButton
                                    key={`${field_type.value}_key`}
                                    id={`column_feed_type-${field_type.value}`}
                                    type="radio"
                                    variant={'outline-primary'}
                                    name={`column_feed_type`}
                                    value={field_type.value}
                                    checked={this.state.column_feed_type === field_type.value}
                                    onChange={(e) => this.handle_field_selected(e.currentTarget.value)}
                                >
                                    {field_type.label}
                                </ToggleButton>
                                ))}
                            </ButtonGroup>
                        </Form.Group>

                        {(this.state.column_feed_type === 'category')
                            ?
                            <>
                                <Form.Group className="mb-3" controlId="formBasicCheckbox">
                                    <Form.Label>Choose Category</Form.Label>
                                    <Form.Select disabled>
                                        <option>Disabled select</option>
                                    </Form.Select>
                                </Form.Group> 
                                <Form.Group className="mb-3" controlId="formBasicCheckbox">
                                    <Form.Label>Field Data as</Form.Label>
                                    <Form.Select disabled>
                                        <option>Disabled select</option>
                                    </Form.Select>
                                </Form.Group> 
                            </>
                            : 
                            <></>
                        }

                        {(this.state.column_feed_type === 'attribute')
                            ?
                            <>
                                <Form.Group className="mb-3" controlId="formBasicCheckbox">
                                    <Form.Label>Choose Attribute</Form.Label>
                                    <Form.Select disabled>
                                        <option>Disabled select</option>
                                    </Form.Select>                                
                                </Form.Group>
                                <Form.Group className="mb-3" controlId="formBasicCheckbox">
                                    <Form.Label>Field Data as</Form.Label>
                                    <Form.Select disabled>
                                        <option>Disabled select</option>
                                    </Form.Select>                                
                                </Form.Group> 
                            </>
                            : 
                            <></>
                        }

                        {(this.state.column_feed_type === 'meta')
                            ?
                            <Form.Group className="mb-3" controlId="formBasicCheckbox">
                                <Form.Label>Choose Meta / Enter Meta Key</Form.Label>
                                <Form.Select disabled>
                                    <option>Disabled select</option>
                                </Form.Select>
                                <br/>
                                <Form.Control type="text" placeholder="Column Label"/>
                            </Form.Group> 
                            : 
                            <></>
                        }

                        <InputGroup style={{'display':'flex','justify-content': 'flex-end'}}>
                            <Button variant="secondary" onClick={handleClose}> Close </Button>
                            <Button variant="primary" onClick={()=>this.handle_add}>Save</Button>
                        </InputGroup>
                    </Form>
                </Modal.Body>
            </Modal>
          </>);
	}
}

export default AddColumnForm;
