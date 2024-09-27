import React, {useState} from 'react';
import {useNavigate} from "react-router-dom";
import websiteRoutes from "../../config/routes/website-routes.tsx";
import SaveForm from "../common/form/SaveForm.tsx";
import UserApiGateway from "../../api/gateway/UserApiGateway.tsx";

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
            const user = await UserApiGateway.createUser(userCreate);
            navigate(websiteRoutes.user.details(user.id));
        } catch (error) {
            console.log(error);
        }
    }

    const togglePasswordVisibility = () => {
        const passwordField = document.getElementById('password')! as HTMLInputElement;
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
        } else {
            passwordField.type = 'password';
        }
    }

    return (
        <SaveForm submitFunction={handleSubmit}>
            <div className={"columns"}>
                <div className={"column"}>
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
                        <input type={"password"} id={"password"} name={"plainPassword"} required={true} onChange={handleInputChange}/>
                        <input type="checkbox" onChange={togglePasswordVisibility} />Show password
                    </div>
                </div>
            </div>
        </SaveForm>
    )
}

export default UserCreateForm;