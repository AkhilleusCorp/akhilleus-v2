import React, {useState} from 'react';
import {useNavigate} from "react-router-dom";
import websiteRoutes from "../../setup/router/websiteRoutes.tsx";
import SaveForm from "../common/form/SaveForm.tsx";
import UserApiGateway from "../../services/api/gateway/UserApiGateway.tsx";
import {TextField} from "@mui/material";
import PasswordInput from "../common/input/PasswordInput.tsx";

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

    return (
        <SaveForm submitFunction={handleSubmit}>
            <div className={"columns"}>
                <div className={"column"}>
                    <div>
                        <TextField id="outlined-basic" label="Username" variant="outlined" size="small"
                                   name={"username"} required={true} onChange={handleInputChange} />
                    </div>
                    <div>
                        <TextField id="outlined-basic" label="Email" variant="outlined" size="small"
                                   name={"email"} type={"email"} required={true} onChange={handleInputChange} />
                    </div>
                    <div>
                        <PasswordInput handleInputChange={handleInputChange} />
                    </div>
                </div>
            </div>
        </SaveForm>
    )
}

export default UserCreateForm;