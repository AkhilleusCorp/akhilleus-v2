import React from 'react';
import {useNavigate} from "react-router-dom";
import {useState} from "react";
import websiteRoutes from "../../setup/router/websiteRoutes.tsx";
import SaveForm from "../common/form/SaveForm.tsx";
import UserApiGateway from "../../services/api/gateway/UserApiGateway.tsx";
import UserDTO from "../../services/api/dtos/UserDTO.tsx";
import {TextField} from "@mui/material";

type UserEditFormType = {
    user: UserDTO,
}

const UserEditForm: React.FC<UserEditFormType> = ({user}) => {
    const navigate = useNavigate();
    const [userUpdated, setUserUpdated] = useState<UserDTO>(user);

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
            setUserUpdated({
                ...userUpdated,
                [event.target.name]: event.target.value
            });
    }

    const handleSubmit = async () => {
        try {
            await UserApiGateway.updateUser(user.id, userUpdated);
            navigate(websiteRoutes.user.details(user.id));
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <SaveForm submitFunction={handleSubmit}>
            <div>
                <TextField id="outlined-basic" label="Username" variant="outlined" size="small" required={true}
                           name={"username"} value={userUpdated.username} onChange={handleInputChange} />
            </div>
            <div>
                <TextField id="outlined-basic" label="Email" variant="outlined" size="small" required={true}
                           name={"email"} type={"email"} value={userUpdated.email} onChange={handleInputChange} />
            </div>
            <div>
                <TextField id="outlined-basic" label="Status" variant="outlined" size="small" required={true}
                           name={"status"} value={userUpdated.status} onChange={handleInputChange} />
            </div>
        </SaveForm>
    )
}

export default UserEditForm;