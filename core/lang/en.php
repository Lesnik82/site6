<?

# Пишу скрипты, модули с 0 
# PHP <=> 7.4, MySQL, MySQL(i), AJAX
# Author Xaori69otori
# Telegram @Xaori69otori

# Английский язык

$lang = array(

'home'						=>		'Home',
'auth'						=>		'Login',
'reg'						=>		'Registration',
'recovery'					=>		'Recovery',
'download'					=>		'Download',
'nick'						=>		'Nickname',
'nick-email'				=>		'Nickname or Email',
'login'						=>		'Login',
'password' 	   				=>		'Password',
'come' 	       				=>		'Log in',
'no-pass' 	       			=>		'Forgot Password',
'new-account' 	    		=>		'Create an Account',
'yes-rules' 	    		=>		'I agree with',
'reg-email' 	    		=>		'Please provide your real Email, a confirmation link will be sent to it',
'ruless' 	   				=>		'the rules',
'accept-rules' 	   			=>		'You must accept the rules',
'subs' 	       				=>		'Subscriptions',
'follows'     				=>		'Followers',
'publi'     				=>		'Publications',
'edit'          			=>		'Edit',
'delete'        			=>		'Delete',
'contacts'      			=>		'Contacts',
'feed'          			=>		'News',
'profile'       			=>		'Profile',
'notify'        			=>		'Notifications',
'direct'        			=>		'Messages',
'settings'      			=>		'Settings',
'adminka'          			=>		'Admin Panel',
'exit'          			=>		'Exit',
'exit'          			=>		'Exit',
'p-subs'          			=>		'Subscribe',
'p-unsubs'          		=>		'Unsubscribe',
'p-nosubs'          		=>		'Cancel Request',
'edit-photo'    			=>		'Change Profile Photo',
'name'          			=>		'Name',
'user-name'     			=>		'Username',
'site'          			=>		'Website',
'biog'          			=>		'Biography',
'd-edit'        			=>		'Personal Information Settings',
'email'         			=>		'Email',
'phone'         			=>		'Phone Number',
'floor'         			=>		'Gender',
'birthday'      			=>		'Birthday',
'main-settings' 			=>		'Main Settings',
'edit-about'    			=>		'Please provide personal information, even if the account is used for a company, pets, or other purposes. This information will not be shown on your public profile.',
'privacy'       			=>		'Privacy',
'security'      			=>		'Security',
'account'       			=>		'Account',
'dakr-mode'     			=>		'Dark Mode',
'lang'          			=>		'Site Language',
'balance'       			=>		'Balance',
'set-view-profile'       	=>		'Who can view my profile',
'set-direct'       			=>		'Who can send me messages',
'set-view-fav'       		=>		'Who can see my favorites',
'all-users'       			=>		'All Users',
'only-subs'       			=>		'Only Subscribers',
'just-me'       			=>		'Only Me',
'set-view-profile-text' 	=>		'If you have a private account, only people you approve can see your photos and videos on Ukrgram. This doesn\'t apply to your existing followers.',
'set-online'       	=>		'Online Status',
'set-online-show'       	=>		'Show Online Status',
'set-online-text'       	=>		'Let users you follow and anyone you message see when you were last active. If you turn this off, you won\'t see the online status of other users.',
'set-pass'       			=>		'Current Password',
'set-n-pass'       			=>		'New Password',
'set-n-pass2'       		=>		'Repeat New Password',
'set-err-n-pass1'       	=>		'Enter both current and new passwords',
'set-err-n-pass2'       	=>		'New password confirmation doesn\'t match',
'set-err-n-pass3'       	=>		'Enter both current and new passwords with at least 3 characters',
'set-err-n-pass4'       	=>		'Cyrillic characters are not allowed in the old password',
'set-err-n-pass5'       	=>		'Cyrillic characters are not allowed in the new password',
'set-err-n-pass6'       	=>		'Incorrect current password entered',
'set-n-pass-succes'       	=>		'Password changed',
'no-public'       			=>		'No publications',
'no-notify'       			=>		'No notifications',
'no-fav'       				=>		'No favorites',
'no-subs'       			=>		'No subscriptions',
'no-follows'       			=>		'No followers',
'no-request'       			=>		'No requests',
'no-direct'       			=>		'No chats',
'no-mess'       			=>		'No messages',
'no-like'       			=>		'No likes',
'no-reg'					=>		'Registration is temporarily unavailable. <br> Please try again later.',
'no-users'       			=>		'No users',
'no-admins'       			=>		'No administrators',
'no-attach'       			=>		'No attachments',
'no-info'       			=>		'No information',
'only-for-subs'       		=>		'Only for subscribers',
'search'         			=>		'Search',
'for-you'         			=>		'For You',
'accounts'         			=>		'Accounts',
'places'         			=>		'Places',
'tags'         				=>		'Tags',
'search-no'         		=>		'Nothing found',
'help'         				=>		'Help',
'sogl'         				=>		'Agreement',
'male'         				=>		'Male',
'female'       				=>		'Female',
'another'       			=>		'Other',
'no-sex'       				=>		'Prefer not to say',
'title'         			=>		'Title',
'save'         				=>		'Save',
'back'         				=>		'Back',
'text'         				=>		'Text',
'photo'         			=>		'Photo',
'write'    					=>		'Write',
'mess'    					=>		'Message',
'your-mess'    				=>		'Your message',
'new-public'    			=>		'New publication',
'new-story'    				=>		'New story',
'upload'    				=>		'Upload',
'publish'    				=>		'Publish',
'add'    					=>		'Add',
'like'    					=>		'Like',
'liked'    					=>		'Liked',
'more'    					=>		'More',
'public'    				=>		'Publication',
'post'    					=>		'Post',
'stories'    				=>		'Stories',
'light'    					=>		'Light',
'dark'    					=>		'Dark',
'accept'    				=>		'Accept',
'reject'    				=>		'Reject',
'signa'    					=>		'Signature',
'add-signa'    				=>		'Add signature',
'add-place'    				=>		'Add place',
'example'    				=>		'Example',
'data-saved'    			=>		'Data saved',
'clear'    					=>		'Clear cache',
'all'    					=>		'All',
'new'    					=>		'New',
'enter-nick'				=>		'Enter nickname',
'error-nick'				=>		'Forbidden nickname',
'enter-pass'				=>		'Enter password',
'enter-email'	 			=>		'Enter Email',
'err-nick-long' 	 		=>		'Nickname should be at least 4 and no more than 30 characters long',
'err-nick-lang' 	 		=>		'Cyrillic characters are not allowed in the nickname',
'err-num'	 				=>		'Only digits are not allowed',
'err-sym'	 				=>		'Using the same symbol is not allowed',
'err-pass-long'	 		=>		'Password should be at least 5 characters long',
'err-nick-close'	 		=>		'An account with this nickname already exists',
'err-email-close'	 		=>		'An account with this Email already exists',
'sent-conf'	 			=>		'A confirmation email has been sent to your Email',
'sent-pass'	 			=>		'A new password has been sent to your Email for login',
'account-act'	 			=>		'Account activated',
'err-email'	 			=>		'Email entered incorrectly',
'err-pass' 				=>		'Cyrillic characters are not allowed in the password',
'no-account' 				=>		'Account not found',
'continue' 					=>		'Continue',
'about-us' 					=>		'About Us',
'rules' 					=>		'Rules',
'faq' 						=>		'Frequently Asked Questions',
'contacts' 					=>		'Contacts',
'admins' 					=>		'Administrators',
'no-money' 					=>		'Insufficient funds',
'page' 						=>		'Page',
'custom' 					=>		'Custom',
'official' 					=>		'Official',
'level'    					=>		'Level',
'user' 						=>		'User',
'moder' 					=>		'Moderator',
'admin' 					=>		'Administrator',
'founder' 					=>		'Founder',
'show-comm' 				=>		'Show more comments',
'share' 					=>		'Share',
'attach' 					=>		'Attachments',
'upload' 					=>		'Upload',
'upload-text' 				=>		'Allowed file formats: png, jpg, jpeg, gif, mp4, and mov. Video files can be up to three minutes in length and should not exceed',
'upload-file' 				=>		'Photos and videos together are not allowed',
'upload-type' 				=>		'Unsupported format',
'upload-size' 				=>		'File is too large',
'notify-comm'    			=>		'commented on your post',
'notify-like'    			=>		'liked your post',
'notify-follow'    			=>		'started following you',
'notify-request'    		=>		'Follow requests',
'notify-request-confirm'    =>		'Confirm or ignore requests',
'main'    					=>		'Main',
'contacts'    				=>		'Contacts',
'ban'    					=>		'Ban',
'keywords'    				=>		'Keywords',
'description'    			=>		'Description',
'access'    				=>		'Access',
'access-1'    				=>		'Everyone',
'access-2'    				=>		'Registered Users Only',
'access-3'    				=>		'Admins Only',
'reg-1'    					=>		'Open',
'reg-2'    					=>		'With Confirmation',
'reg-3'    					=>		'Closed',
'publics'    				=>		'Publications',
'elem'    					=>		'Elements',
'official-page'    			=>		'Official page',
'video-time'    			=>		'Video hour',
'video-size'    			=>		'Video size',
'users'    					=>		'Users',
'blocked'    				=>		'Blocked',
'visits'    				=>		'Visits',
'cause'    					=>		'Cause',
'time'    					=>		'Time',
'block'    					=>		'Block',
'unlock'    				=>		'Unlock',
'ac-block'    				=>		'Account is blocked',
'ac-unlock'    				=>		'Account is unlocked',
'ac-block-time'    			=>		'Account is blocked until',
'unmute'    				=>		'Tap to unmute',
'keyboard'    				=>		'Press spacebar to view further',
'day1' 		    			=>		'Today at',
'day2' 		    			=>		'Yesterday at',
'day3' 		    			=>		'Day before yesterday at',
'jan' 		    			=>		'Jan',
'feb' 		    			=>		'Feb',
'mar' 		    			=>		'Mar',
'apr' 		    			=>		'Apr',
'may' 		    			=>		'May',
'jun' 		    			=>		'Jun',
'jul' 		    			=>		'Jul',
'aug' 		    			=>		'Aug',
'sen' 		    			=>		'Sep',
'oct' 		    			=>		'Oct',
'noy' 		    			=>		'Nov',
'dec' 		    			=>		'Dec',
'ago'          				=>   	'ago',
'hours'        				=>   	'hours',
'minute'      				=>   	'minute',
'minutes'      				=>   	'minutes',
'fromnow'      				=>   	'from now',
'seconds'      				=>   	'seconds',
'yesterday'    				=>   	'yesterday',
'tomorrow'     				=>   	'tomorrow',
'days'         				=>   	'days',
'hour' 		    			=>		'Hour',
'day' 		    			=>		'Day',
'week' 		    			=>		'Week',
'month' 		    		=>		'Month',
'months' 		    		=>		'Months',
'months2' 		    		=>		'Months',
'year' 		    			=>		'Year',
'january' 		    		=>		'January',
'february' 		    		=>		'February',
'march' 		    		=>		'March',
'april' 		    		=>		'April',
'may' 		    			=>		'May',
'june' 		    			=>		'June',
'july' 		    			=>		'July',
'august' 		    		=>		'August',
'september' 				=>		'September',
'october' 		    		=>		'October',
'november' 		    		=>		'November',
'december' 		    		=>		'December',
'about-us-text' => '

<div class="mb-10">
Social network <b>Wondergam</b>!
</div>
<div class="mb-10">
Wondergam is a virtual community where you can enjoy communication, meet interesting people, share photos and videos, express your opinions, preserve important moments in life, chat in personal chats, and share exciting moments of your life.
</div>
Wondergam is your source of endless possibilities for social interaction.

',
'sogl-text' => '

<div class="mb-10">
Recognition and agreement with the terms. A user who registers and uses the social network automatically agrees to all the terms of this Agreement.
</div>
<div class="mb-10">
User\'s responsibility. The user is fully responsible for any information they publish on the social network, including copyright and compliance with the laws and rules of the social network.
</div>
<div class="mb-10">
Interaction with other users. The user undertakes to respect the rights and freedoms of other users, not to insult them, and not to violate the laws and rules of the social network.
</div>
<div class="mb-10">
Data confidentiality. The social network is committed to maintaining the confidentiality of users\' personal data and not to disclose them to third parties without the user\'s consent, except as provided by law.
</div>
<div class="mb-10">
Right to deletion. The user has the right to request the deletion of their data from the social network under any circumstances.
</div>
<div class="mb-10">
Social network\'s responsibility. The social network is not responsible for any damage caused to users or third parties associated with the use of the social network.
</div>
<div class="mb-10">
Changes to the agreement. The social network has the right to change the terms of this Agreement at its discretion and without notifying users. The user must periodically check the terms of this Agreement to stay informed of any changes.
</div>
',
'rules-text' => '

<div class="mb-10">
User behavior. Users must behave responsibly on the social network and respect other users. Posting offensive, discriminatory, indecent, or pornographic materials, as well as materials containing violence and other human rights violations, is prohibited.
</div>
<div class="mb-10">
Data confidentiality. Users must adhere to data confidentiality rules and not disclose their login and password to third parties. It is also prohibited to collect, store, or use the information of other users without their consent.
</div>
<div class="mb-10">
Copyright. Users must respect copyright and not publish materials belonging to other individuals without their permission. Users cannot use materials that violate copyright without the consent of their owners.
</div>
<div class="mb-10">
Advertising and spam. Posting irrelevant advertising or spam on the social network is prohibited. Commercial advertising may be allowed only under certain conditions and with the consent of the social network administrators.
</div>
<div class="mb-10">
Undesirable materials. Posting materials on the social network that contain viruses, harmful programs, or other elements that may harm other users or the social network is prohibited.
</div>
<div class="mb-10">
Interaction with administrators. Users must cooperate with the administrators of the social network and report any rule violations they observe.
</div>
',

'contacts-text' 	=>		'If you have any questions, do not hesitate to contact the project administration using the following contacts: mail - Xaotik1998@gmail.com, or Telegram - @xaori69otori. We are always ready to help you!',

'download-text' 	=>		'Wondergram social network app on Android!',

);

?>
