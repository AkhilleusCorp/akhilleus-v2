import UserType from "app/common/utils/types/UserType.tsx";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";
import memberRoutes from "app/member/services/router/memberRoutes.tsx";

class RouteSwitch {
    static switch(userType: UserType) {
        if (userType === 'admin') {
            return adminRoutes;
        }

        return memberRoutes;
    }
}

export default RouteSwitch;