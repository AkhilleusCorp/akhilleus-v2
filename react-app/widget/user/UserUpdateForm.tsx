import React from 'react';
import {useNavigate} from "react-router-dom";
import UserDTO from "../../dtos/UserDTO.tsx";
import {useState} from "react";
import UserAPI from "../../api/UserApi.tsx";
import routes from "../../infrastructure/router/routes-mapping.tsx";

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

    const handleSubmit = async (event: React.FormEvent<HTMLFormElement>) => {
        event.preventDefault();
        try {
            await UserAPI.updateUser(user.id, userUpdated);
            navigate(routes.userDetails(user.id));
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <form onSubmit={handleSubmit}>
            <div>
                <label>Username</label>
                <input type={"text"} name={"username"} value={userUpdated.username} onChange={handleInputChange} required={true}/>
            </div>
            <div>
                <label>Email</label>
                <input type={"email"} name={"email"} value={userUpdated.email} onChange={handleInputChange} required={true}/>
            </div>
            <div>
                <button type={"button"} className={"btn-cancel"} onClick={() => navigate(-1)}>Cancel</button>
                <button type={"submit"} className={"btn-validate"}>Save</button>
            </div>
        </form>
    )
}

export default UserEditForm;