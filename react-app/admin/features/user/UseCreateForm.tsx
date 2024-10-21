import React, {useState} from 'react';
import {useNavigate} from "react-router-dom";
import {TextField} from "@mui/material";
import UserApiGateway from "app/admin/services/api/gateway/UserApiGateway.tsx";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";
import SaveForm from "app/common/components/form/SaveForm.tsx";
import PasswordInput from "app/common/components/input/PasswordInput.tsx";

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
            navigate(adminRoutes.user.details(user.id));
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