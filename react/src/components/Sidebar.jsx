//
// import { useAuth } from '../hooks/useAuth';
//
// export default function Sidebar({ user: userProp }) {
//     const { logout } = useAuth();
//     const user = userProp; // подаван отвън
//
//     return (
//         <aside id="sidebar">
//             <div className="flex flex-col h-full">
//                 <h2 className="text-xl font-semibold text-gray-900 mb-6 pb-4 border-b border-gray-100 flex items-center">
//                     <div className="w-10 h-10 rounded-lg flex items-center justify-center mr-3 overflow-hidden">
//                         <img src="/images/tu-image.png" alt="Лого" className="w-full h-full object-cover" loading="lazy" />
//                     </div>
//                     {user.role === 'student' ? 'Студентски профил' : user.role === 'teacher' ? 'Преподавателски профил' : 'Администраторски профил'}
//                 </h2>
//
//                 <div className="space-y-5 flex-1">
//                     <div className="flex items-center gap-4">
//                         <div className="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center">
//                             <i className="fas fa-user text-xl text-indigo-600"></i>
//                         </div>
//                         <div>
//                             <p className="font-medium text-gray-900">
//                                 {user.role === 'teacher' && user.teacher?.title ? `${user.teacher.title} ` : ''}
//                                 {user.first_name} {user.second_name} {user.last_name}
//                             </p>
//
//                             {user.role === 'student' && (
//                                 <p className="text-sm text-gray-500 mt-1">
//                                     №: <span className="font-mono">{user.student?.faculty_number}</span>
//                                 </p>
//                             )}
//                             {user.role === 'teacher' && (
//                                 <p className="text-sm text-gray-500 mt-1">
//                                     <i className="fas fa-clipboard-list text-gray-400"></i> {user.teacher?.exams_count} активни изпита
//                                 </p>
//                             )}
//                         </div>
//                     </div>
//
//                     {user.role === 'student' && (
//                         <div>
//                             <p className="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Специалност/Факултет</p>
//                             <p className="font-medium text-gray-800">
//                                 {user.student?.specialty?.name} / {user.student?.faculty?.name}
//                             </p>
//                         </div>
//                     )}
//                     {user.role === 'teacher' && (
//                         <div>
//                             <p className="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Факултет</p>
//                             <p className="font-medium text-gray-800">{user.teacher?.faculty?.name}</p>
//                         </div>
//                     )}
//
//                     <div>
//                         <p className="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Потребителско име</p>
//                         <p className="font-medium text-gray-800">{user.username}</p>
//                     </div>
//
//                     <div>
//                         <p className="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Имейл</p>
//                         <p className="font-medium text-gray-800">{user.email}</p>
//                     </div>
//                 </div>
//
//                 <button onClick={logout} className="mt-6 w-full px-4 py-2.5 rounded-xl text-white font-medium bg-red-500 hover:bg-red-600 transition-colors">
//                     <i className="fas fa-sign-out-alt mr-2"></i> Изход
//                 </button>
//             </div>
//         </aside>
//     );
// }
import { useAuth } from '../hooks/useAuth';
import logoImage from '../../public/images/tu-image.png'; // или правилния път
export default function Sidebar({ user: userProp }) {
    const { logout } = useAuth();
    const user = userProp;

    return (
        <aside id="sidebar">
            <div className="flex flex-col h-full">
                <h2 className="text-xl font-semibold text-gray-900 mb-6 pb-4 border-b border-gray-100 flex items-center">
                    <div className="w-10 h-10 rounded-lg flex items-center justify-center mr-3 overflow-hidden">
                        <img
                            src={logoImage}
                             alt="Лого" className="w-full h-full object-cover" loading="lazy" />
                    </div>
                    {/*{user.role === 'student' ? 'Студентски профил' : user.role === 'teacher' ? 'Преподавателски профил' : 'Администраторски профил'}*/}
                    <span className={
                        user.role === 'student' ? 'text-xl' :
                            user.role === 'teacher' ? 'text-lg' :
                                'text-base'
                    }>
                        {user.role === 'student' ? 'Студентски профил' :
                            user.role === 'teacher' ? 'Преподавателски профил' :
                                'Администраторски профил'}
                    </span>
                </h2>

                <div className="space-y-5 flex-1">
                    <div className="flex items-center gap-4">
                        <div className="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center">
                            <i className="fas fa-user text-xl text-blue-600"></i>
                        </div>
                        <div>
                            <p className="font-medium text-gray-900">
                                {user.role === 'teacher' && user.teacher?.title ? `${user.teacher.title} ` : ''}
                                {user.first_name} {user.second_name} {user.last_name}
                            </p>

                            {user.role === 'student' && (
                                <p className="text-sm text-gray-500 mt-1">
                                    №: <span className="font-mono">{user.student?.faculty_number}</span>
                                </p>
                            )}

                        </div>
                    </div>

                    <div className="space-y-3.5 mt-4">
                        {user.role === 'student' && (
                            <div>
                                <p className="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Специалност/Факултет</p>
                                <p className="font-medium text-gray-800">
                                    {user.student?.specialty?.name} / {user.student?.faculty?.name}
                                </p>
                            </div>
                        )}
                        {user.role === 'teacher' && (
                            <div>
                                <p className="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Факултет</p>
                                <p className="font-medium text-gray-800">{user.teacher?.faculty?.name}</p>
                            </div>
                        )}

                        <div>
                            <p className="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Потребителско име</p>
                            <p className="font-medium text-gray-800">{user.username}</p>
                        </div>

                        <div>
                            <p className="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Имейл</p>
                            <p className="font-medium text-gray-800">{user.email}</p>
                        </div>

                        <div>
                            <p className="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Телефонен номер</p>
                            <p className="font-medium text-gray-800">{user.phone || 'Не е посочен'}</p>
                        </div>

                        {user.role === 'student' && (
                            <div>
                                <p className="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Статус</p>
                                {user.student?.semester < 8 ? (
                                    <p className="font-medium text-green-600 flex items-center gap-1.5">
                                        <i className="fas fa-check-circle"></i>Активен
                                    </p>
                                ) : (
                                    <p className="font-medium text-red-600 flex items-center gap-1.5">
                                        <i className="fas fa-times-circle"></i>Неактивен
                                    </p>
                                )}
                            </div>
                        )}
                    </div>
                </div>

                <div className="pt-4 border-t border-gray-100">
                    <button
                        onClick={logout}
                        className="w-full flex items-center justify-center gap-2 px-4 py-3 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors"
                    >
                        <i className="fas fa-sign-out-alt"></i>
                        <span>Изход от системата</span>
                    </button>
                </div>
            </div>
        </aside>
    );
}
