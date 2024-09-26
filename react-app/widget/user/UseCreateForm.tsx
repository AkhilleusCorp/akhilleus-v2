import React, {useState} from 'react';
import UserAPI from "../../api/UserApi.tsx";
import {useNavigate} from "react-router-dom";
import routes from "../../infrastructure/router/routes-mapping.tsx";
import SaveForm from "../common/form/SaveForm.tsx";

type UserCreateFormType = {
    username: string;
    email: string;
    plainPassword: string;
}

const UserCreateForm: React.FC = () => {
    const [userCreate, setUserCreate] = useState<UserCreateFormType>({username: '', email: '', plainPassword: ''});
    const navigate = useNavigate();

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
            setUserCreate({
                ...userCreate,
                [event.target.name]: event.target.value
            });
    }

    const handleSubmit = async () => {
        try {
            const user = await UserAPI.createUser(userCreate);
            navigate(routes.user.details(user.id));
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <SaveForm submitFunction={handleSubmit}>
            <div>
                <label>Username</label>
                <input type={"text"} name={"username"} required={true} onChange={handleInputChange}/>
            </div>
            <div>
                <label>Email</label>
                <input type={"email"} name={"email"} required={true} onChange={handleInputChange}/>
            </div>
            <div>
                <label>Password</label>
                <input type={"text"} name={"plainPassword"} required={true} onChange={handleInputChange}/>
            </div>
        </SaveForm>
    )
}

export default UserCreateForm;